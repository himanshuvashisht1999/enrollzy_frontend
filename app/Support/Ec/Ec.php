<?php

namespace App\Support\Ec;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Shared rules of the "Exams, Counselling & Cutoffs" pages (client design "enrollzy-exams-counselling-cutoffs"):
 * where an exam or a counselling stands today, listing order, dates, tiles and server-side paging.
 * Everything is worked out from the API's dates, never typed.
 */
class Ec
{
    public const EXAM_LABEL = ['open' => 'Open', 'closing' => 'Closing soon', 'upcoming' => 'Upcoming', 'closed' => 'Closed', 'result' => 'Result out'];
    public const COUN_LABEL = ['live' => 'Round live', 'between' => 'Between rounds', 'upcoming' => 'Upcoming', 'completed' => 'Completed', 'tba' => 'Schedule awaited'];
    public const COUN_PILL = ['live' => 'open', 'between' => 'closing', 'upcoming' => 'upcoming', 'completed' => 'closed', 'tba' => 'upcoming'];
    public const LEVEL = ['national' => 'All India', 'state' => 'State', 'university' => 'University', 'institute' => 'Institute'];
    public const PER_PAGE = [10, 25, 50];
    public const CUT_PER_PAGE = [15, 30, 50];

    public static function today(): Carbon
    {
        return now()->startOfDay();
    }

    public static function d(?string $iso): ?Carbon
    {
        return $iso ? Carbon::parse($iso)->startOfDay() : null;
    }

    public static function days(?Carbon $d): ?int
    {
        return $d ? (int) self::today()->diffInDays($d, false) : null;
    }

    public static function fmt(?Carbon $d, bool $year = true): string
    {
        return $d ? $d->format($year ? 'j M Y' : 'j M') : ($year ? 'To be announced' : 'TBA');
    }

    public static function inDays(?Carbon $d): string
    {
        $n = self::days($d);
        return $n === null ? '' : ($n === 0 ? 'today' : ($n === 1 ? 'tomorrow' : 'in ' . $n . ' days'));
    }

    public static function num($n): string
    {
        if ($n === null || $n === '') return '–';
        $f = (float) $n;
        if (floor($f) != $f) return rtrim(rtrim(number_format($f, 2), '0'), '.');
        $s = (string) (int) $f;
        return strlen($s) > 3 ? preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', substr($s, 0, -3)) . ',' . substr($s, -3) : $s;
    }

    // ------------------------------------------------------------------ exams

    /**
     * Where an exam stands: open | closing (closes within 10 days) | upcoming | closed | result, plus its list group
     * (0 open, 1 upcoming, 2 closed) and the dates behind it.
     */
    public static function examState(array $e): array
    {
        $k = $e['key_dates'] ?? [];
        $rs = self::d($k['registration']['start'] ?? null);
        $re = self::d($k['registration']['end'] ?? null) ?? $rs;
        $ex = self::d($k['exam']['start'] ?? null);
        $res = self::d($k['result']['start'] ?? null);
        $t = self::today();
        $regState = $e['status']['registration']['state'] ?? null;
        if ($rs && $re) {
            $state = $t->lt($rs) ? 'upcoming' : ($t->lte($re) ? (self::days($re) <= 10 ? 'closing' : 'open') : ($res && $t->gte($res) ? 'result' : 'closed'));
        } else {
            // no registration dates: rolling / through school registrations are open; otherwise go by the exam date
            $state = $regState === 'open' ? 'open' : ($ex && $t->gt($ex) ? ($res && $t->gte($res) ? 'result' : 'closed') : 'upcoming');
        }
        return ['state' => $state, 'grp' => in_array($state, ['open', 'closing']) ? 0 : ($state === 'upcoming' ? 1 : 2),
            'rs' => $rs, 're' => $re, 'ex' => $ex, 'res' => $res, 'apply_url' => $k['registration']['link_url'] ?? null];
    }

    /** Status order inside the list: open by closing date, upcoming by opening date, closed by exam date (results last). */
    public static function sortExams(Collection $list): Collection
    {
        return $list->sortBy(fn ($e) => [$e['_s']['grp'],
            $e['_s']['grp'] === 0 ? ($e['_s']['re']?->timestamp ?? PHP_INT_MAX) : ($e['_s']['grp'] === 1 ? ($e['_s']['rs']?->timestamp ?? $e['_s']['ex']?->timestamp ?? PHP_INT_MAX)
                : ($e['_s']['state'] === 'result' ? 1 : 0) * 10 ** 11 + ($e['_s']['ex']?->timestamp ?? 0)),
            Str::lower($e['name'])])->values();
    }

    // ------------------------------------------------------------------ counselling

    /**
     * Where a counselling stands, from its rounds' date spans: live (a round is running) | between | upcoming |
     * completed | tba (no round has dates yet), with the current and next round.
     */
    public static function counState(array $c): array
    {
        $rounds = collect($c['rounds'] ?? [])->map(fn ($r) => $r + ['s' => self::d($r['start'] ?? null), 'e' => self::d($r['end'] ?? null)]);
        $dated = $rounds->filter(fn ($r) => $r['s']);
        $t = self::today();
        $cur = $dated->first(fn ($r) => $t->gte($r['s']) && $t->lte($r['e']));
        $next = $dated->filter(fn ($r) => $r['s']->gt($t))->sortBy(fn ($r) => $r['s']->timestamp)->first();
        if ($dated->isEmpty()) $state = 'tba';
        elseif ($cur) $state = 'live';
        elseif ($dated->every(fn ($r) => $r['s']->gt($t))) $state = 'upcoming';
        elseif ($next) $state = 'between';
        else $state = 'completed';
        // a cancelled / postponed cycle shows as such through the API's "now"
        return ['state' => $state, 'grp' => in_array($state, ['live', 'between']) ? 0 : (in_array($state, ['upcoming', 'tba']) ? 1 : 2),
            'cur' => $cur, 'next' => $next, 'first' => $dated->sortBy(fn ($r) => $r['s']->timestamp)->first(), 'last' => $dated->sortBy(fn ($r) => $r['e']->timestamp)->last(),
            'rounds' => $rounds->values()->all()];
    }

    public static function sortCouns(Collection $list): Collection
    {
        return $list->sortBy(function ($c) {
            $s = $c['_s'];
            $key = $s['grp'] === 0 ? (($s['cur'] ?? $s['next'])['e'] ?? null)?->timestamp : ($s['grp'] === 1 ? ($s['first']['s'] ?? null)?->timestamp : -(($s['last']['e'] ?? null)?->timestamp ?? 0));
            return [$s['grp'], $key ?? PHP_INT_MAX, Str::lower($c['name'])];
        })->values();
    }

    public static function counSort(array $c): string
    {
        return ($c['level'] === 'state' ? '1' : '0') . Str::lower(implode(',', $c['states'] ?? []) . $c['name']);
    }

    /** Line icons of the section (exam, counselling, cutoffs) or any 24x24 path. */
    public static function svg(string $k): string
    {
        $icons = [
            'exam' => '<rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h4"/>',
            'coun' => '<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><path d="M16 4h5v5h-5zM16 13h5"/>',
            'cut' => '<path d="M3 3v18h18"/><path d="M7 15l4-4 3 3 5-6"/>',
            'search' => '<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',
        ];
        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . ($icons[$k] ?? $k) . '</svg>';
    }

    // ------------------------------------------------------------------ tiles, links

    /** Short label for a logo tile ("NEET", "JEE", "Pun" for a state). */
    public static function initials(string $name, ?string $short = null, ?array $states = null): string
    {
        if ($states && count($states) === 1) {
            $w = preg_split('/[\s&]+/', $states[0], -1, PREG_SPLIT_NO_EMPTY);
            return count($w) > 1 ? implode('', array_map(fn ($x) => mb_strtoupper(mb_substr($x, 0, 1)), $w)) : mb_substr($states[0], 0, 3);
        }
        $s = trim((string) ($short ?: $name));
        $first = preg_split('/\s+/', $s)[0];
        return mb_strlen($first) <= 6 ? $first : collect(preg_split('/\s+/', $s))->filter(fn ($w) => preg_match('/^[A-Z]/', $w))->map(fn ($w) => mb_substr($w, 0, 1))->take(4)->implode('');
    }

    /** Tile colour by stream. */
    public static function tint(?string $stream): string
    {
        $k = Str::lower((string) $stream);
        return match (true) {
            Str::contains($k, ['medic', 'nurs', 'dental', 'ayush', 'pharm']) => '#e5f6ee',
            Str::contains($k, ['engineer', 'tech', 'architect']) => '#dce9fb',
            Str::contains($k, ['law']) => '#ffe3ef',
            Str::contains($k, ['manag', 'mba', 'business']) => '#fff1e4',
            Str::contains($k, ['design', 'fashion', 'art']) => '#fde6d8',
            Str::contains($k, ['state']) => '#fff4dc',
            default => '#eef1ff',
        };
    }

    // ------------------------------------------------------------------ dates and text from the CRM

    /** Status pill of one dated event: [css class, label]. */
    public static function eventPill(array $ev): array
    {
        $st = $ev['status'] ?? null;
        $start = self::d($ev['start_at'] ?? null);
        return match ($st) {
            'open' => ['open', 'Open now'],
            'upcoming' => $start && self::days($start) <= 10 ? ['closing', ucfirst(self::inDays($start))] : ['upcoming', 'Upcoming'],
            'expected' => ['upcoming', 'Expected'],
            'closed' => ['closed', 'Done'],
            'declared' => ['result', 'Out'],
            'postponed', 'cancelled' => ['closing', ucfirst($st)],
            default => ['upcoming', 'Awaited'],
        };
    }

    /** The event's own name: its label, else its type, with the stage when the exam has several. */
    public static function eventName(array $ev): string
    {
        return trim(($ev['label'] ?: ($ev['type']['name'] ?? 'Date')) . (!empty($ev['stage']) ? ' (' . $ev['stage'] . ')' : '') . (!empty($ev['quota']) ? ' · ' . $ev['quota'] : ''));
    }

    /** "03 Aug 2026, 12:00 AM - 31 Oct 2026, 11:59 PM" -> "03 Aug 2026 - 31 Oct 2026": whole-day times say nothing. */
    public static function dateText(?string $t): string
    {
        return trim(preg_replace('/,\s*(12:00 AM|11:59 PM)/', '', (string) $t));
    }

    /** Text the admin typed (plain or rich): only simple formatting tags and safe links are kept. */
    public static function rich(?string $html): string
    {
        $html = trim((string) $html);
        if ($html === '') return '';
        if ($html === strip_tags($html)) return nl2br(e($html));
        $html = strip_tags($html, '<p><br><ul><ol><li><b><strong><i><em><u><a><h3><h4><table><thead><tbody><tr><th><td>');
        $html = preg_replace('/\s(on\w+|style|class|id)\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        return preg_replace('/href\s*=\s*(["\']?)\s*(javascript|data|vbscript):[^"\'>\s]*\1/i', 'href="#"', $html);
    }

    /** "₹1,700" for a fee row. */
    public static function money($amount, ?string $currency = 'INR'): string
    {
        if ($amount === null || $amount === '') return '–';
        return ($currency && strtoupper($currency) !== 'INR' ? strtoupper($currency) . ' ' : '₹') . self::num($amount);
    }

    // ------------------------------------------------------------------ paging (server side, ?page=&per_page=)

    /** One page of a list: items, page, pages, size, from, to, total. Status order is applied before paging. */
    public static function page(Collection $list, Request $request, string $prefix = '', array $sizes = self::PER_PAGE): array
    {
        $size = in_array((int) $request->query($prefix . 'per_page'), $sizes, true) ? (int) $request->query($prefix . 'per_page') : $sizes[0];
        $pages = max(1, (int) ceil($list->count() / $size));
        $page = min(max(1, (int) $request->query($prefix . 'page', 1)), $pages);
        return ['items' => $list->slice(($page - 1) * $size, $size)->values(), 'page' => $page, 'pages' => $pages, 'size' => $size, 'sizes' => $sizes,
            'from' => $list->count() ? ($page - 1) * $size + 1 : 0, 'to' => min($page * $size, $list->count()), 'total' => $list->count(), 'prefix' => $prefix];
    }

    /** The current URL with some query values changed (null removes one). */
    public static function url(Request $request, array $changes, ?string $base = null): string
    {
        $q = array_filter(array_merge($request->query(), $changes), fn ($v) => $v !== null && $v !== '');
        ksort($q);
        return ($base ?? $request->url()) . ($q ? '?' . http_build_query($q) : '');
    }
}
