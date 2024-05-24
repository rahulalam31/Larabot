<?php

namespace rahulalam31\Larabot\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \rahulalam31\Larabot\Larabot
 */
class Larabot extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \rahulalam31\Larabot\Larabot::class;
    }
}
