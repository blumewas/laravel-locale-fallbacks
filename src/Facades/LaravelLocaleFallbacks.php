<?php

namespace Blumewas\LaravelLocaleFallbacks\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Blumewas\LaravelLocaleFallbacks\LaravelLocaleFallbacks
 */
class LaravelLocaleFallbacks extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Blumewas\LaravelLocaleFallbacks\LaravelLocaleFallbacks::class;
    }
}
