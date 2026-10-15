<?php

namespace Modules\UserActivity\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIpChange
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (! $user) {
            return $next($request);
        }

        // Admin bypass: editors switch WiFi/mobile data often - don't force logout
        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return $next($request);
        }

        // Global toggle via .env (CHECK_IP_CHANGE=false to disable for all)
        if (! config('useractivity.check_ip_change', true)) {
            return $next($request);
        }

        $currentIp = (string) $request->ip();
        $userTrack = $user->userTracks()->latest()->first();
        if ($userTrack && $userTrack->ip !== null && $userTrack->ip !== $currentIp) {
            // Mobile networks rotate IPs often on the same device. Only force
            // logout when the device also changed (likely session hijack).
            // Same device + new IP (e.g. mobile data) stays logged in.
            $trackedAgent = (string) ($userTrack->user_agent ?? '');
            $currentAgent = (string) $request->userAgent();
            // Same device (same browser) + any IP = stay logged in.
            // Mobile data rotates IPs; only a different device forces logout.
            if ($trackedAgent !== '' && $trackedAgent === $currentAgent) {
                return $next($request);
            }
            Auth::logout();

            return to_route('login')->withErrors(__('Your IP address has changed, please login again.'));
        }

        return $next($request);
    }
}
