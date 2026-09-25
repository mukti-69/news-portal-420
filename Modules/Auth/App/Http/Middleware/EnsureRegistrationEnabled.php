<?php

namespace Modules\Auth\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Blocks access to the public self-registration routes when they are
 * disabled via config (auth.registration_enabled, env: REGISTRATION_ENABLED).
 *
 * Defaults to enabled so existing behaviour/tests are unaffected; production
 * deployments should set REGISTRATION_ENABLED=false in .env to close public
 * sign-up (e.g. when only a fixed, small editorial team should have accounts).
 */
class EnsureRegistrationEnabled
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('auth.registration_enabled', true)) {
            abort(404);
        }

        return $next($request);
    }
}
