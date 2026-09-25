<?php

namespace Modules\Common\App\Helpers;

use Carbon\Carbon;
use DateTimeInterface;

/**
 * Gregorian-calendar date helper.
 *
 * This class used to proxy every call straight to morilog/jalali's
 * Jalalian, converting all dates to the Persian calendar. It has been
 * rewritten to proxy to Carbon instead, so dates now render in the
 * standard Gregorian calendar used in Bangladesh.
 *
 * Kept as the same class name with the same public API - forge(), now(),
 * and the ->format()/->ago() methods on the object it returns - so the
 * existing call sites across the codebase (jalalian()->forge(...)->format(...),
 * jalalian()->now()->format(...), jalalian()->forge(...)->ago()) keep working
 * unchanged. The format strings already in use (e.g. 'Y/m/d H:i:s', 'd F Y')
 * are standard PHP date() tokens, which Carbon's format() also accepts.
 */
class JalalianHelper
{
    public function __construct()
    {
        if (! Carbon::hasMacro('ago')) {
            Carbon::macro('ago', function () {
                /** @var Carbon $this */
                return $this->diffForHumans();
            });
        }
    }

    public function forge(DateTimeInterface|string|null $date): Carbon
    {
        return Carbon::parse($date);
    }

    public function now(): Carbon
    {
        return Carbon::now();
    }
}
