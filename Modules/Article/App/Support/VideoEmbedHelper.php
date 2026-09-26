<?php

namespace Modules\Article\App\Support;

/**
 * Turns a plain YouTube or Facebook video URL - the kind an editor copies
 * straight from their browser's address bar or the Share button - into a
 * URL that is safe to put in an <iframe src="..."> on the article page.
 *
 * Nothing is fetched from YouTube/Facebook here; this only parses the URL
 * string the editor typed in. Unrecognized URLs return null, so the caller
 * can simply not render a video block rather than embedding something
 * unexpected.
 */
class VideoEmbedHelper
{
    public static function toEmbedUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $url = trim($url);

        if ($youtubeId = self::extractYoutubeId($url)) {
            return 'https://www.youtube-nocookie.com/embed/'.$youtubeId;
        }

        if (self::isFacebookVideoUrl($url)) {
            return 'https://www.facebook.com/plugins/video.php?href='.urlencode($url).'&show_text=false';
        }

        return null;
    }

    public static function platform(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        if (self::extractYoutubeId($url)) {
            return 'youtube';
        }

        if (self::isFacebookVideoUrl($url)) {
            return 'facebook';
        }

        return null;
    }

    private static function extractYoutubeId(string $url): ?string
    {
        $host = parse_url($url, PHP_URL_HOST);

        if (! $host || ! preg_match('/(^|\.)(youtube\.com|youtube-nocookie\.com|youtu\.be)$/i', $host)) {
            return null;
        }

        // youtu.be/{id}
        if (preg_match('/^youtu\.be$/i', $host)) {
            $path = trim((string) parse_url($url, PHP_URL_PATH), '/');

            return self::isValidYoutubeId($path) ? $path : null;
        }

        // youtube.com/watch?v={id}
        parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
        if (! empty($query['v']) && self::isValidYoutubeId($query['v'])) {
            return $query['v'];
        }

        // youtube.com/embed/{id}, /shorts/{id}, /live/{id}
        $path = trim((string) parse_url($url, PHP_URL_PATH), '/');
        if (preg_match('#^(?:embed|shorts|live)/([A-Za-z0-9_-]{6,})#', $path, $matches)) {
            return self::isValidYoutubeId($matches[1]) ? $matches[1] : null;
        }

        return null;
    }

    private static function isValidYoutubeId(string $id): bool
    {
        return (bool) preg_match('/^[A-Za-z0-9_-]{6,15}$/', $id);
    }

    private static function isFacebookVideoUrl(string $url): bool
    {
        $host = parse_url($url, PHP_URL_HOST);

        if (! $host) {
            return false;
        }

        return (bool) preg_match('/(^|\.)(facebook\.com|fb\.watch)$/i', $host);
    }
}
