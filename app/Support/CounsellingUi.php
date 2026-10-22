<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;

/** Small display helpers shared by the counselling and exam pages. */
class CounsellingUi
{
    /** Status pill for a "now" state or an event status: [css modifier, label]. */
    public static function pill(?string $state, ?string $label = null): array
    {
        [$cls, $default] = match ($state) {
            'open' => ['open', 'Open now'],
            'upcoming' => ['soon', 'Upcoming'],
            'declared' => ['declared', 'Result out'],
            'closed', 'completed' => ['closed', 'Closed'],
            'expected' => ['tba', 'Expected'],
            'postponed' => ['tba', 'Postponed'],
            'cancelled', 'withheld' => ['closed', ucfirst((string) $state)],
            'not_announced' => ['tba', 'Not announced'],
            default => ['tba', 'Awaited'],
        };
        return [$cls, $label ?? $default];
    }

    /** Pill for one dated event in a dates table. */
    public static function eventPill(array $e): array
    {
        if (($e['status'] ?? null) === 'upcoming' && in_array($e['date_precision'] ?? null, ['month_only', 'tentative'], true)) {
            return ['tba', 'Expected'];
        }
        return match ($e['status'] ?? null) {
            'open' => ['open', $e['status_text'] ?? 'Open'],
            'upcoming' => ['soon', 'Upcoming'],
            'closed' => ['closed', 'Closed'],
            'declared' => ['declared', 'Declared'],
            'expected' => ['tba', 'Expected'],
            'to_be_announced', 'not_announced' => ['tba', 'TBA'],
            default => self::pill($e['status'] ?? null),
        };
    }

    public static function pillHtml(?string $state, ?string $label = null): HtmlString
    {
        [$cls, $text] = self::pill($state, $label);
        return new HtmlString('<span class="cz-pill ' . $cls . '">' . e($text) . '</span>');
    }

    public static function eventPillHtml(array $e): HtmlString
    {
        [$cls, $text] = self::eventPill($e);
        return new HtmlString('<span class="cz-pill ' . $cls . '">' . e($text) . '</span>');
    }

    public static function chanceHtml($closing, ?int $rank, bool $higherIsWorse = true): HtmlString
    {
        $c = self::chance($closing, $rank, $higherIsWorse);
        return new HtmlString($c ? '<span class="cz-chance ' . $c[0] . '">' . $c[1] . '</span>' : '');
    }

    /** Indian digit grouping: 1234567 -> 12,34,567. */
    public static function num($n): string
    {
        if ($n === null || $n === '') return '–';
        $n = (float) $n;
        $neg = $n < 0 ? '-' : '';
        $int = (string) (int) round(abs($n));
        if (strlen($int) > 3) {
            $last = substr($int, -3);
            $rest = substr($int, 0, -3);
            $int = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $rest) . ',' . $last;
        }
        return $neg . $int;
    }

    public static function inr($n): string
    {
        return $n === null ? '–' : '₹' . self::num($n);
    }

    /** "Good chance" / "Borderline" / "Unlikely" for a rank against a closing rank (ranks only, not scores). */
    public static function chance($closing, ?int $rank, bool $higherIsWorse = true): ?array
    {
        if (!$rank || $closing === null || !$higherIsWorse) return null;
        if ($rank <= $closing * 0.85) return ['good', 'Good chance'];
        if ($rank <= $closing * 1.05) return ['border', 'Borderline'];
        return ['low', 'Unlikely'];
    }

    public static function date(?string $iso, string $format = 'j M Y'): ?string
    {
        return $iso ? Carbon::parse($iso)->format($format) : null;
    }

    /** The visitor's "Your details" (home state, category id, rank), kept in a plain cookie by counselling.js. */
    public static function profile(Request $request, array $states = []): array
    {
        $raw = json_decode((string) $request->cookie('ez_profile'), true);
        $raw = is_array($raw) ? $raw : [];
        $state = is_string($raw['state'] ?? null) ? trim($raw['state']) : null;
        if ($states && !in_array($state, $states, true)) $state = null;
        $rank = filter_var($raw['rank'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5000000]]);
        $cat = filter_var($raw['cat'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        return ['state' => $state ?: null, 'cat' => $cat ?: null, 'rank' => $rank ?: null];
    }

    /** National counsellings and the home state's own are "for you". */
    public static function isMine(array $c, ?string $state): bool
    {
        return ($c['level'] ?? null) === 'national' || ($state && in_array($state, $c['states'] ?? [], true));
    }

    public const LEVELS = ['national' => 'National', 'state' => 'State', 'university' => 'University', 'institute' => 'Institute'];

    /** Open first, then upcoming, result out, closed, awaited. */
    public static function statusOrder(?string $state): int
    {
        return ['open' => 0, 'upcoming' => 1, 'declared' => 2, 'closed' => 3, 'postponed' => 4, 'tba' => 5, 'cancelled' => 6][$state] ?? 5;
    }

    /** Short label on a logo tile when there is no logo image. */
    public static function initials(array $c): string
    {
        $s = trim((string) ($c['short_name'] ?? ''));
        if ($s === '') {
            $s = collect(preg_split('/\s+/', (string) ($c['name'] ?? '')))->filter()->map(fn ($w) => mb_substr($w, 0, 1))->take(3)->implode('');
        }
        return mb_strtoupper(mb_substr(str_replace(' ', '', $s), 0, 5));
    }
}
