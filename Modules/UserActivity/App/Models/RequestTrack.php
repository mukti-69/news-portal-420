<?php

namespace Modules\UserActivity\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;

class RequestTrack extends Model
{
    use Searchable;

    protected $fillable = [
        'user_track_id',
        'url',
        'referer',
        'tag',
    ];

    /** User-agents that must never inflate public view counters. */
    public static array $botPatterns = [
        '%bot%', '%crawl%', '%spider%', '%slurp%',
        '%uptimerobot%', '%uptime%', '%monitor%', '%pingdom%',
    ];

    protected static function humanQuery()
    {
        return self::whereNotExists(function ($q) {
            $q->selectRaw('1')
                ->from('user_tracks')
                ->whereColumn('user_tracks.id', 'request_tracks.user_track_id')
                ->where(function ($w) {
                    foreach (self::$botPatterns as $p) {
                        $w->orWhere('user_tracks.user_agent', 'LIKE', $p);
                    }
                });
        });
    }

    public static function getVisitCounts(): array
    {
        $now = Carbon::now();

        $hourCount = self::humanQuery()->where('request_tracks.created_at', '>=', $now->copy()->subHour())->count();
        $tenHoursCount = self::humanQuery()->where('request_tracks.created_at', '>=', $now->copy()->subHours(10))->count();
        $dayCount = self::humanQuery()->where('request_tracks.created_at', '>=', $now->copy()->subDay())->count();

        $weekCount = self::humanQuery()->where('request_tracks.created_at', '>=', $now->copy()->subWeek())->count();
        $monthCount = self::humanQuery()->where('request_tracks.created_at', '>=', $now->copy()->subMonth())->count();
        $yearCount = self::humanQuery()->where('request_tracks.created_at', '>=', $now->copy()->subYear())->count();

        $allCount = self::humanQuery()->count();

        return [
            'hourly' => $hourCount,
            'ten_hours' => $tenHoursCount,
            'daily' => $dayCount,
            'weekly' => $weekCount,
            'monthly' => $monthCount,
            'yearly' => $yearCount,
            'all' => $allCount,
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'user_track_id' => (int) $this->user_track_id,
            'url' => $this->url,
            'referer' => $this->referer,
            'tag' => $this->tag,
        ];
    }

    public function userTrack(): BelongsTo
    {
        return $this->belongsTo(UserTrack::class);
    }
}
