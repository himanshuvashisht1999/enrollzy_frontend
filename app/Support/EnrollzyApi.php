<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Reads the backend's public API (counselling + exam data). Answers are cached for a minute, so a page view
 * costs at most a few calls and the backend's own cache does the rest.
 *
 * get() returns the decoded JSON, null for a 404 (the page should 404 too), and throws ApiUnavailable when the
 * backend cannot be reached or fails, so the page can show a friendly "try again" instead of a broken layout.
 */
class EnrollzyApi
{
    public static function get(string $path, array $query = []): ?array
    {
        $query = array_filter($query, fn ($v) => $v !== null && $v !== '' && $v !== false);
        ksort($query);
        $key = 'ez-api:' . sha1($path . '?' . http_build_query($query));

        $hit = Cache::get($key);
        if (is_array($hit)) {
            return $hit['found'] ? $hit['data'] : null;
        }

        $cfg = config('services.enrollzy_api');
        try {
            $res = Http::acceptJson()->timeout($cfg['timeout'])->connectTimeout(4)
                ->withHeaders(array_filter(['X-Site-Key' => $cfg['site_key']]))
                ->get($cfg['url'] . '/' . ltrim($path, '/'), $query);
        } catch (\Throwable $e) {
            Log::warning('Enrollzy API unreachable: ' . $path . ' - ' . $e->getMessage());
            throw new ApiUnavailable($e->getMessage(), 0, $e);
        }

        if ($res->status() === 404) {
            // Only the API's own "not found" (unknown or unpublished counselling / exam / year) is a real 404. A 404 for the
            // route itself means the backend has not deployed the API (or BACKEND_URL points elsewhere): that is an outage,
            // not "no data", so the page says "try again" instead of showing an empty list.
            $message = (string) ($res->json('message') ?? '');
            if (!preg_match('/^(Counselling not found|Exam not found|No public cycle)/', $message)) {
                Log::error('Enrollzy API route missing (404) for ' . $path . ': check BACKEND_URL and that the backend API is deployed (routes/api.php, bootstrap/app.php, php artisan route:clear).');
                throw new ApiUnavailable('API route missing: ' . $path);
            }
            Cache::put($key, ['found' => false, 'data' => null], $cfg['cache_seconds']);
            return null;
        }
        if (!$res->successful() || !is_array($res->json())) {
            Log::warning('Enrollzy API error ' . $res->status() . ': ' . $path);
            throw new ApiUnavailable('API answered ' . $res->status());
        }

        $data = $res->json();
        Cache::put($key, ['found' => true, 'data' => $data], $cfg['cache_seconds']);
        return $data;
    }

    /** Every page of a paginated list (the counselling list is short: a few pages at most). */
    public static function all(string $path, array $query = [], int $maxPages = 10): array
    {
        $out = [];
        for ($page = 1; $page <= $maxPages; $page++) {
            $res = self::get($path, $query + ['per_page' => 50, 'page' => $page]);
            if ($res === null) {
                throw new ApiUnavailable('List endpoint answered 404: ' . $path);
            }
            array_push($out, ...($res['data'] ?? []));
            if ($page >= (int) ($res['meta']['last_page'] ?? 1)) break;
        }
        return $out;
    }
}
