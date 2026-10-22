<?php

namespace App\Support\University;

/**
 * Links between the pages of one university, carrying the page-wide campus choice (?campus=slug) along.
 */
class UniLinks
{
    public function __construct(private string $slug, private ?string $campus)
    {
    }

    private function q(array $extra = []): array
    {
        return array_filter(['slug' => $this->slug, 'campus' => $this->campus] + $extra, fn ($v) => $v !== null && $v !== '');
    }

    public function overview(string $anchor = ''): string
    {
        return route('university.detail', $this->q()) . $anchor;
    }

    public function courses(array $filters = []): string
    {
        return route('university.courses', $this->q($filters));
    }

    public function course(string $courseSlug, ?string $campusSlug = null): string
    {
        $q = $this->q(['course' => $courseSlug]);
        if ($campusSlug !== null) $q['campus'] = $campusSlug;
        return route('university.course', $q);
    }

    public function campus(?string $campusSlug = null): string
    {
        return route('university.campus', array_filter(['slug' => $this->slug, 'campusSlug' => $campusSlug ?? $this->campus]));
    }

    public function online(): string
    {
        return route('university.online', $this->q());
    }

    public function compare(string $tab = ''): string
    {
        return route('university.compare', $this->q(['tab' => $tab ?: null]));
    }

    /** The same page for another campus (null = all campuses); every other filter is dropped, as the design asks. */
    public function withCampus(string $routeName, array $params, ?string $campusSlug): string
    {
        return route($routeName, array_filter($params + ['slug' => $this->slug, 'campus' => $campusSlug]));
    }

    public function campusSlug(): ?string
    {
        return $this->campus;
    }
}
