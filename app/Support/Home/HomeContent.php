<?php

namespace App\Support\Home;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * The homepage's words, links, order and visibility, from the admin "Homepage Sections" (homepage_sections table).
 * Each section has a row: title, subtitle, button (cta_title / cta_url), badge (settings.badge_text, shown as the small
 * label above a heading) and its own lists in settings (rotating words, stage cards, steps, points...). Anything the
 * admin has not filled in falls back to the client design's text below, so the page is complete before the rows exist.
 *
 * The backend edit form for each section is App\Support\HomepageSectionSchema (backend), with the same keys.
 */
class HomeContent
{
    /** Section key => partial, in the design's order (used for sections that have no row yet). */
    public const SECTIONS = [
        'hero_banner' => 'hero', 'journey_stages' => 'stages', 'happening_now' => 'now', 'university_grid' => 'streams',
        'university_comparison' => 'compare', 'online_degrees' => 'online', 'noteworthy_mentions' => 'skills',
        'specialized_courses' => 'scholarships', 'institute_marquee' => 'boarding', 'free_counselling' => 'help',
        'school_marquee' => 'coaching', 'expert_carousel' => 'experts', 'testimonials' => 'trust', 'blogs' => 'blogs', 'faq' => 'faq',
    ];

    public static function defaults(): array
    {
        return [
            'hero_banner' => ['badge' => 'DPIIT recognised education marketplace', 'title' => 'Find the right', 'subtitle' => 'Dates, fees and courses for colleges, exams, counselling and scholarships, plus a free counsellor when you need help deciding.',
                'title_after' => 'and get in.', 'rotating_words' => ['college', 'course', 'school', 'scholarship', 'exam'],
                'search_placeholder' => 'Try “MBA in Pune” or “NEET UG”',
                'popular' => [['label' => 'Online MBA', 'url' => '#online'], ['label' => 'B.Tech', 'url' => '/search?q=B.Tech'], ['label' => 'MBA', 'url' => '/search?q=MBA'], ['label' => 'Scholarships', 'url' => '/scholarships-and-benefits']],
                'popular_live_exam' => true,
                'assurances' => ['Exam dates from official notices', 'Counselling is free', 'Compare before you apply'], 'show_live' => true],
            'journey_stages' => ['badge' => 'Start here', 'title' => 'Where are you on the road?', 'subtitle' => 'Pick your stage. We\'ll show you the four things that matter most right now.', 'default_stage' => 2,
                'stages' => [
                    ['name' => 'After Class 10', 'icon' => 'ten', 'cards' => [
                        ['title' => 'Choose your stream', 'text' => 'Science, Commerce or Arts and where each leads', 'url' => '/career-roadmap'],
                        ['title' => 'Schools for Class 11', 'text' => 'Compare by board, fees and city', 'url' => '/all-schools?class=Class+11'],
                        ['title' => 'JEE / NEET foundation', 'text' => 'Coaching institutes and programmes', 'url' => '/all-coaching'],
                        ['title' => 'Diploma options', 'text' => 'Polytechnic and skill diplomas', 'url' => '/courses?search=Diploma']]],
                    ['name' => 'After Class 12', 'icon' => 'twelve', 'cards' => [
                        ['title' => 'Entrance exams', 'text' => 'JEE, NEET, CUET, CLAT: dates and eligibility', 'url' => '/top-exams'],
                        ['title' => 'Colleges and universities', 'text' => 'Filter by course, state and fees', 'url' => '/university'],
                        ['title' => 'Counselling rounds', 'text' => 'MCC, JoSAA and your state', 'url' => '/counselling'],
                        ['title' => 'Scholarships', 'text' => 'Merit, income and category based', 'url' => '/scholarships-and-benefits']]],
                    ['name' => 'Graduates', 'icon' => 'grad', 'cards' => [
                        ['title' => 'Postgraduate courses', 'text' => 'MBA, M.Tech, M.Sc, MCA', 'url' => '/courses?search=Master'],
                        ['title' => 'CAT, GATE and PG exams', 'text' => 'Dates, eligibility and pattern', 'url' => '/top-exams'],
                        ['title' => 'Online master\'s', 'text' => 'Study while you work', 'url' => '#online'],
                        ['title' => 'Talk to an expert', 'text' => 'Plan your next step with a counsellor', 'url' => '/experts']]],
                    ['name' => 'Working', 'icon' => 'work', 'cards' => [
                        ['title' => 'Online and executive MBA', 'text' => 'Weekend and online formats', 'url' => '#online'],
                        ['title' => 'Upskilling', 'text' => 'Data, AI, cloud, cybersecurity', 'url' => '#skills'],
                        ['title' => 'Switch careers', 'text' => 'Talk to a career expert', 'url' => '/experts'],
                        ['title' => 'PhD while working', 'text' => 'Part-time research programmes', 'url' => '/courses?search=PhD']]],
                    ['name' => 'Parents', 'icon' => 'parent', 'cards' => [
                        ['title' => 'School admissions', 'text' => 'Nursery to Class 12, by city and board', 'url' => '/all-schools'],
                        ['title' => 'Boarding schools', 'text' => 'Facilities, fees and safety', 'url' => '#boarding'],
                        ['title' => 'Fees and scholarships', 'text' => 'Scholarships for school and college', 'url' => '/scholarships-and-benefits'],
                        ['title' => 'Free counselling', 'text' => 'A call about your child\'s options', 'url' => '#help']]],
                ]],
            'happening_now' => ['badge' => 'Don\'t miss a date', 'title' => 'Happening now', 'subtitle' => 'Registrations, counselling rounds and scholarship deadlines, from official notices.',
                'exams_label' => 'Exam registrations', 'coun_label' => 'Counselling rounds', 'sch_label' => 'Scholarship deadlines', 'rows' => 5],
            'university_grid' => ['title' => 'Pick a stream', 'subtitle' => 'Top universities, entrance exams and courses for it, in one place.'],
            'university_comparison' => ['badge' => 'University comparison', 'title' => 'Compare before you decide', 'cta_title' => null, 'cta_url' => null,
                'subtitle' => 'Put up to three options side by side: fees, placements, approvals and rankings. The same course at different universities, any mix of courses and universities, or courses within one university.'],
            'online_degrees' => ['badge' => 'Online degrees', 'title' => "Study online.\nSame university, no relocation.", 'subtitle' => 'Compare online MBA, BBA, MCA and more from {count} universities by fees and duration, then talk to an online admissions advisor.',
                'points' => ['Degrees from the universities themselves', 'Study from home, no hostel cost', 'Total fee shown upfront'],
                'cta_title' => 'Talk to an online advisor', 'panel_title' => 'Popular online programmes', 'items' => 4],
            'noteworthy_mentions' => ['title' => 'In-demand programmes and skills', 'subtitle' => 'Curated programmes, high-demand skills and free courses to move your career forward.'],
            'specialized_courses' => ['badge' => 'Fund your studies', 'title' => 'Scholarships you can apply for', 'subtitle' => '{count} scholarships listed. Tell us your level and category.', 'cta_title' => 'All scholarships', 'cta_url' => '/scholarships-and-benefits'],
            'institute_marquee' => ['title' => 'Boarding schools', 'subtitle' => 'Nurturing environments for holistic growth and learning.', 'cta_title' => 'View all schools', 'cta_url' => '/all-schools'],
            'free_counselling' => ['badge' => 'Free counselling', 'title' => "Not sure what to choose?\nTalk to a counsellor, free.", 'subtitle' => 'A short call about your marks, budget and goals. You leave with a shortlist, not a sales pitch.',
                'points' => ['No charge for admission counselling', 'One call, about 20 minutes'], 'cta_title' => 'Book free counselling', 'panel_title' => 'How it works',
                'steps' => [['title' => 'Share your details', 'text' => 'Your marks, exam scores, budget and preferred cities.'], ['title' => 'Get a shortlist', 'text' => 'Colleges and courses that fit, with fees and dates.'], ['title' => 'Apply with support', 'text' => 'Help with forms, documents and counselling rounds.']],
                'form_title' => 'Book free counselling', 'form_text' => 'Share your number and a counsellor will call you back, free.',
                'form_options' => ['College / university', 'Online degree', 'School admission', 'Entrance exam help', 'Scholarship', 'Career advice'],
                'mobile_bar' => true],
            'school_marquee' => ['title' => 'Coaching institutes', 'subtitle' => 'Expert guidance to help you crack every exam.', 'cta_title' => 'View all coaching institutes', 'cta_url' => '/all-coaching'],
            'expert_carousel' => ['title' => 'Our team of experts', 'subtitle' => 'Experienced counsellors and academic experts dedicated to student success.', 'cta_title' => 'View all experts', 'cta_url' => '/experts', 'items' => 4],
            'testimonials' => ['title' => 'Why students trust Enrollzy', 'subtitle' => 'Dates, fees and details come from official sources, and admission counselling is always free.',
                'pillars' => [['icon' => 'calendar', 'title' => 'Dates with sources', 'text' => 'Exam and counselling dates are taken from the official notices.'],
                    ['icon' => 'shield', 'title' => 'Compare in the open', 'text' => 'Fees, campuses and placements side by side, with the year each figure is from.'],
                    ['icon' => 'award', 'title' => 'DPIIT-recognised', 'text' => 'Admission counselling is free. You are never charged by Enrollzy for an admission.']],
                'show_reviews' => true, 'show_counts' => true],
            'blogs' => ['title' => 'Blogs', 'subtitle' => 'Guides on courses, colleges, exams and careers from our counselling team.', 'cta_title' => 'View all blogs', 'cta_url' => '/blogs', 'items' => 4],
            'faq' => ['title' => 'The FAQ zone', 'subtitle' => 'Quick answers about courses, admissions and how Enrollzy works.', 'cta_title' => 'View all FAQs', 'cta_url' => '/faq', 'items' => 5],
        ];
    }

    /** ['order' => [key...] (visible only), 'c' => key => content] */
    public static function load(): array
    {
        $rows = DB::table('homepage_sections')->get()->keyBy('section_key');
        $defaults = self::defaults();
        $keys = array_keys(self::SECTIONS);
        $c = [];
        foreach ($defaults as $key => $d) {
            $row = $rows[$key] ?? null;
            $s = $row ? (is_array($row->settings) ? $row->settings : (json_decode((string) $row->settings, true) ?: [])) : [];
            $own = array_filter([
                'title' => self::clean($row->title ?? null), 'subtitle' => trim((string) ($row->subtitle ?? '')) ?: null,
                'cta_title' => trim((string) ($row->cta_title ?? '')) ?: null, 'cta_url' => trim((string) ($row->cta_url ?? '')) ?: null,
                'badge' => trim((string) ($s['badge_text'] ?? '')) ?: null,
            ], fn ($v) => $v !== null);
            // section-specific settings: a value the admin saved is used as saved (an emptied list stays empty, an
            // unticked option stays off); a setting never saved uses the design's default. Numbers must be 1 or more.
            foreach ($s as $k => $v) {
                if (in_array($k, ['badge_text', 'items_visibility'], true) || !array_key_exists($k, $d)) continue;
                if (is_bool($d[$k])) $own[$k] = (bool) (int) $v;
                elseif (is_int($d[$k])) { if ((int) $v > 0) $own[$k] = (int) $v; }
                elseif (is_array($d[$k])) $own[$k] = self::cleanList($v);
                else $own[$k] = trim((string) $v);
            }
            if ($key === 'hero_banner' && !isset($own['badge']) && !empty($row->cta_title)) $own['badge'] = trim($row->cta_title);   // where the old hero kept its pill
            $c[$key] = array_merge(['badge' => null, 'title' => null, 'subtitle' => null, 'cta_title' => null, 'cta_url' => null], $d, $own)
                + ['visible' => !$row || (int) $row->is_visible === 1];
        }
        $order = collect($keys)->sortBy(fn ($k) => isset($rows[$k]) ? [(int) $rows[$k]->sort_order, 0] : [array_search($k, $keys) + 1, 1])
            ->filter(fn ($k) => $c[$k]['visible'])->values()->all();
        return ['order' => $order, 'c' => $c];
    }

    /** A cache stamp that changes whenever the admin saves a section (or the data behind one). */
    public static function stamp(): string
    {
        $max = fn ($t) => rescue(fn () => (string) DB::table($t)->max('updated_at'), '', false);
        return md5(implode('|', array_map($max, ['homepage_sections', 'homepage_stream_tabs', 'noteworthy_categories', 'noteworthy_mentions', 'scholarships', 'experts', 'blogs', 'faqs', 'testimonials', 'seo_homepage'])));
    }

    /** Lists from the admin form: rows with every field empty are dropped; plain lists lose empty lines. */
    private static function cleanList($v): array
    {
        if (is_string($v)) $v = preg_split('/\r?\n/', $v);
        return collect((array) $v)->map(function ($r) {
            if (!is_array($r)) return trim((string) $r) === '' ? null : trim((string) $r);
            if (isset($r['cards'])) $r['cards'] = self::cleanList($r['cards']);
            $r = array_map(fn ($x) => is_string($x) ? trim($x) : $x, $r);
            return collect($r)->except('cards')->filter(fn ($x) => $x !== '' && $x !== null)->isEmpty() ? null : $r;
        })->filter()->values()->all();
    }

    /** "BOARDING SCHOOL" (old upper-case titles) -> "Boarding School". */
    private static function clean(?string $t): ?string
    {
        $t = trim((string) $t);
        if ($t === '') return null;
        return mb_strtoupper($t) === $t ? Str::title(mb_strtolower($t)) : $t;
    }

    /** "/x" and "#x" stay as they are; a full URL to this site's own pages stays too. */
    public static function url(?string $u): ?string
    {
        $u = trim((string) $u);
        if ($u === '') return null;
        return Str::startsWith($u, ['http://', 'https://', '#', 'mailto:', 'tel:']) ? $u : url($u);
    }

    /** {count} in a text -> the number. */
    public static function fill(?string $text, $count): string
    {
        return str_replace('{count}', number_format((int) $count), (string) $text);
    }

    /** Icons the admin can pick for stages and trust pillars (24x24 stroke paths). */
    public const ICONS = [
        'ten' => '<path d="M4 19V6a2 2 0 012-2h12v15H6a2 2 0 00-2 2z"/><path d="M8 8h6"/>',
        'twelve' => '<path d="M3 9l9-5 9 5-9 5z"/><path d="M7 11v5c3 2 7 2 10 0v-5"/>',
        'grad' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2"/>',
        'work' => '<path d="M4 18l5-5 4 4 7-8"/><path d="M14 9h6v6"/>',
        'parent' => '<circle cx="8" cy="7" r="3"/><circle cx="17" cy="9" r="2.4"/><path d="M2 20c.6-3.5 3-5.5 6-5.5s5.4 2 6 5.5M14 20c.4-2.6 1.6-4 3-4s3 1.4 3.6 4"/>',
        'calendar' => '<rect x="4" y="5" width="16" height="15" rx="2"/><path d="M4 10h16M9 3v4M15 3v4"/>',
        'shield' => '<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/><path d="M9 12l2 2 4-4"/>',
        'award' => '<circle cx="12" cy="9" r="5"/><path d="M8.5 13.5L7 21l5-3 5 3-1.5-7.5"/>',
        'book' => '<path d="M4 5h6a2 2 0 0 1 2 2v13a2 2 0 0 0-2-2H4zM20 5h-6a2 2 0 0 0-2 2v13a2 2 0 0 1 2-2h6z"/>',
        'star' => '<path d="M12 3l2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9z"/>',
        'chat' => '<path d="M4 5h16v11H8l-4 4z"/>',
        'search' => '<circle cx="11" cy="11" r="6"/><path d="M20 20l-4.5-4.5"/>',
        'money' => '<rect x="3" y="6" width="18" height="12" rx="2"/><circle cx="12" cy="12" r="2.5"/>',
        'globe' => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 010 18M12 3a14 14 0 000 18"/>',
    ];

    public static function icon(?string $name): string
    {
        return self::ICONS[$name] ?? self::ICONS['twelve'];
    }
}
