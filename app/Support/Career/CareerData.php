<?php

namespace App\Support\Career;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Data of the career roadmap page, from the existing Career Roadmap module (admin: Career Roadmap → Categories,
 * Stages, Sub Modules): categories = the stage groups, stages = the classes, top-level sub modules of a class =
 * its groups ("What interests you?"), and a group's tree = its roadmap. Plus the blogs / Ask Enrollzy questions
 * of each topic. Cached until the admin saves (stamp) or for ten minutes.
 */
class CareerData
{
    /** Icons by words in a group's title (first match wins). */
    private const ICON_WORDS = [
        'def' => 'defence|army|navy|air force|nda|military|police', 'med' => 'medical|medicine|doctor|neet|pcb|health|nursing|pharma',
        'eng' => 'engineer|jee|pcm|technology|tech|coding|computer|science', 'ca' => 'commerce|ca\b|finance|account|bank',
        'biz' => 'management|mba|business|commrce', 'law' => 'law|legal|clat', 'gov' => 'government|civil|upsc|ias|ssc',
        'des' => 'design|creative|art|humanities|hospitality', 'arts' => 'sport|olympiad|talent|leader|skill|exploring|aptitude',
        'data' => 'exam|competitive|entrance|test|scholarship', 'arch' => 'dual|mode|switch|vocational|iti|stream|international',
    ];

    public const ICONS = [
        'med' => '<path d="M10 3h4v7h7v4h-7v7h-4v-7H3v-4h7z"/>',
        'eng' => '<circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M5 19l2-2M17 7l2-2"/>',
        'biz' => '<path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/>',
        'law' => '<path d="M12 3v18M5 7h14M7 7l-3 7h6zM17 7l-3 7h6z"/>',
        'des' => '<path d="M4 20l4-1 11-11-3-3L5 16z"/>',
        'gov' => '<path d="M3 21h18M5 21V10M19 21V10M9 21V10M15 21V10M2 10l10-6 10 6z"/>',
        'def' => '<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/>',
        'data' => '<path d="M3 3v18h18"/><path d="M7 15l4-4 3 3 5-6"/>',
        'ca' => '<rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 7h8M8 11h8M8 15h4"/>',
        'arch' => '<path d="M3 21h18M5 21V9l7-5 7 5v12M10 21v-6h4v6"/>',
        'arts' => '<circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 4-6 8-6s7 2 8 6"/>',
    ];

    public static function icon(string $k): string
    {
        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . (self::ICONS[$k] ?? self::ICONS['eng']) . '</svg>';
    }

    public static function stamp(): string
    {
        $max = fn ($t) => rescue(fn () => DB::table($t)->max('updated_at') . '/' . DB::table($t)->count(), '', false);
        return md5($max('career_roadmap_categories') . $max('career_roadmap_stages') . $max('career_roadmap_sub_modules'));
    }

    public static function build(array $c): array
    {
        return Cache::remember('career-page:v2:' . self::stamp(), 600, fn () => self::structure() + self::learn($c['topics']));
    }

    // ------------------------------------------------------------------ the module's structure

    /** Stage groups with their classes, the groups of each class (with item titles for search) and the trees, by group id. */
    private static function structure(): array
    {
        $cats = rescue(fn () => DB::table('career_roadmap_categories')->where('status', 1)->orderBy('id')->get(['id', 'name']), collect(), false);
        $stages = rescue(fn () => DB::table('career_roadmap_stages')->where('status', 1)->orderBy('id')->get(['id', 'category_id', 'title', 'slug']), collect(), false);
        $rows = rescue(fn () => DB::table('career_roadmap_sub_modules')->where('status', 1)->orderBy('id')->get(['id', 'stage_id', 'parent_id', 'title', 'description', 'long_description', 'custom_fields']), collect(), false);
        $kids = $rows->groupBy(fn ($r) => (int) $r->parent_id);

        $classes = $stages->map(fn ($s) => ['id' => (int) $s->id, 'cat' => (int) $s->category_id, 'title' => trim($s->title), 'slug' => $s->slug ?: Str::slug($s->title)])->values();
        $groups = [];
        $trees = [];
        foreach ($classes as $cl) {
            foreach ($kids[0] ?? [] as $g) {
                if ((int) $g->stage_id !== $cl['id']) continue;
                $tree = self::tree($g, $kids);
                if (!$tree['steps']) continue;
                $cf = self::fields($g->custom_fields);
                $groups[] = [
                    'id' => (int) $g->id, 'cls' => $cl['id'], 'title' => trim($g->title), 'ic' => self::iconFor($g->title),
                    'hint' => self::hint($g->description) ?: collect($tree['steps'])->pluck('title')->take(4)->implode(' · '),
                    'count' => count($tree['steps']), 'items' => self::titles($tree['steps']), 'alert' => trim(strip_tags((string) ($cf['alert_message'] ?? ''))),
                ];
                $trees[(int) $g->id] = $tree['steps'];
            }
        }
        $cats = $cats->map(fn ($c) => ['id' => (int) $c->id, 'name' => self::cleanName($c->name),
            'classes' => $classes->where('cat', (int) $c->id)->filter(fn ($cl) => collect($groups)->contains('cls', $cl['id']))->pluck('id')->values()->all()])
            ->filter(fn ($c) => $c['classes'])->values()->all();
        return ['cats' => $cats, 'classes' => $classes->keyBy('id')->all(), 'groups' => $groups, 'trees' => $trees];
    }

    /**
     * A group's roadmap: its items as steps (title, text, fee, buttons, sub-items). Levels that only repeat the class
     * ("class 10", "Class 11-12") and carry no text are skipped, so the steps are the real items.
     */
    private static function tree(object $node, $kids): array
    {
        $steps = [];
        foreach (self::unwrap($kids[(int) $node->id] ?? collect(), $kids) as $r) $steps[] = self::item($r, $kids, 1);
        return ['steps' => $steps];
    }

    private static function unwrap($list, $kids)
    {
        $out = collect();
        foreach ($list as $r) {
            $container = preg_match('/^\s*class(es)?\s*[\d\s\-–&,]*\s*$/i', (string) $r->title) && trim(strip_tags((string) $r->description)) === '';
            if ($container) $out = $out->merge(self::unwrap($kids[(int) $r->id] ?? collect(), $kids));
            else $out->push($r);
        }
        return $out;
    }

    private static function item(object $r, $kids, int $depth): array
    {
        $cf = self::fields($r->custom_fields);
        $fee = trim((string) ($cf['Salary'] ?? $cf['salary'] ?? ''));
        $label = trim((string) ($cf['Badge'] ?? $cf['badge'] ?? ''));
        $buttons = collect([1, 2])->map(fn ($i) => ['label' => trim((string) ($cf["btn{$i}_label"] ?? '')), 'url' => trim((string) ($cf["btn{$i}_url"] ?? ''))])
            ->filter(fn ($b) => $b['label'] !== '' && $b['url'] !== '')->map(fn ($b) => $b + ['url' => Str::startsWith($b['url'], ['http', '/', '#']) ? $b['url'] : '/' . $b['url']])->values()->all();
        return [
            'id' => (int) $r->id, 'title' => trim((string) $r->title),
            'text' => self::text($r->description),
            'long' => self::text(strip_tags(str_replace(['<br>', '<br/>', '<br />', '</p>', '</li>'], "\n", (string) $r->long_description))),
            // "Fee" in the badge names the line, which often starts with it already ("Fee - zero")
            'fee' => $fee !== '' ? preg_replace('/^(fee|fees)\s*[-:–]\s*/i', '', $fee) : '', 'feeLabel' => $fee !== '' ? ($label ?: 'Fee') : '',
            'buttons' => $buttons,
            'children' => $depth < 3 ? collect(self::unwrap($kids[(int) $r->id] ?? collect(), $kids))->map(fn ($k) => self::item($k, $kids, $depth + 1))->values()->all() : [],
        ];
    }

    private static function titles(array $steps): array
    {
        $t = [];
        foreach ($steps as $s) { $t[] = $s['title']; foreach ($s['children'] as $k) $t[] = $k['title']; }
        return array_values(array_unique($t));
    }

    private static function fields($v): array
    {
        $a = is_array($v) ? $v : json_decode((string) $v, true);
        return is_array($a) ? $a : [];
    }

    /** Text as entered (line breaks kept, extra blank lines and stray tags removed). */
    private static function text(?string $t): string
    {
        $t = trim(preg_replace("/\n{3,}/", "\n\n", str_replace("\r", '', strip_tags((string) $t))));
        return $t;
    }

    /** The short lines of a group ("NSEJS\n. ITI\n. JEE") as one line: "NSEJS · ITI · JEE". */
    private static function hint(?string $t): string
    {
        $parts = collect(preg_split('/\n+/', self::text($t)))->map(fn ($l) => trim(ltrim(trim($l), '.•-')))->filter();
        return $parts->count() > 1 && $parts->every(fn ($l) => mb_strlen($l) <= 40) ? $parts->take(5)->implode(' · ') : Str::limit($parts->implode(' '), 90);
    }

    private static function iconFor(string $title): string
    {
        foreach (self::ICON_WORDS as $k => $re) if (preg_match('/' . $re . '/i', $title)) return $k;
        return 'eng';
    }

    /** "Early stage ? foundation years" (a dash lost on import) -> "Early stage – foundation years". */
    private static function cleanName(string $n): string
    {
        return trim(preg_replace('/\s+[?�]\s+/u', ' – ', $n));
    }

    // ------------------------------------------------------------------ read, ask and discuss

    /** Latest blogs and approved Ask Enrollzy questions, each tagged with the topics whose words its title contains. */
    private static function learn(array $topics): array
    {
        $topics = collect($topics)->filter(fn ($t) => !empty($t['label']))->map(fn ($t) => [
            'label' => (string) $t['label'],
            're' => collect($t['keywords'] ?? [])->map(fn ($w) => trim((string) $w))->filter()->map(fn ($w) => '(?<![\p{L}\p{N}])' . preg_quote($w, '/') . '(?![\p{L}\p{N}])')->implode('|'),
        ])->filter(fn ($t) => $t['re'] !== '')->values();
        $tag = fn (string $text) => $topics->filter(fn ($t) => preg_match('/' . $t['re'] . '/iu', $text))->pluck('label')->values()->all();
        $file = fn ($p) => $p ? (Str::startsWith($p, 'http') ? $p : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($p, '/')) : null;

        $blogs = rescue(fn () => DB::table('blogs')->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->orderByDesc('published_at')->orderByDesc('id')->limit(60)->get(['id', 'title', 'slug', 'excerpt', 'content', 'image', 'published_at']), collect(), false)
            ->map(fn ($b) => ['title' => $b->title, 'url' => route('blog.detail', $b->slug ?: $b->id), 'img' => $file($b->image), 'topics' => $tag($b->title . ' ' . $b->excerpt),
                'read' => max(1, (int) round(str_word_count(strip_tags((string) $b->content)) / 200)) . ' min read']);

        $threads = rescue(fn () => DB::table('community_questions as q')->where('q.status', 'approved')->where('q.is_active', 1)
            ->orderByDesc('q.created_at')->limit(80)->get(['q.id', 'q.question_text', 'q.created_at']), collect(), false);
        $answers = $threads->isEmpty() ? collect() : DB::table('community_replies')->whereIn('question_id', $threads->pluck('id'))->where('status', 'approved')->where('is_active', 1)
            ->groupBy('question_id')->selectRaw('question_id, count(*) n')->pluck('n', 'question_id');
        $threads = $threads->map(fn ($t) => ['q' => Str::limit(trim((string) $t->question_text), 140), 'url' => route('ask.enrollzy.detail', $t->id),
            'answers' => (int) ($answers[$t->id] ?? 0), 'ago' => $t->created_at ? Carbon::parse($t->created_at)->diffForHumans(null, true) . ' ago' : '',
            'topics' => $tag((string) $t->question_text)]);

        // topics with nothing to show are left out
        $used = $topics->pluck('label')->filter(fn ($l) => $blogs->contains(fn ($b) => in_array($l, $b['topics'], true)) || $threads->contains(fn ($t) => in_array($l, $t['topics'], true)))->values();
        return ['topics' => $used->all(), 'blogs' => $blogs->values()->all(), 'threads' => $threads->values()->all()];
    }
}
