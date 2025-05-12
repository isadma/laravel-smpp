<?php

namespace Isadma\LaravelSmpp\Facades;

use Illuminate\Support\Facades\Facade;
use Isadma\LaravelSmpp\SmppService;

/**
 * @method static bool sendMessage(string $to, string $message)
 * @see \Isadma\LaravelSmpp\SmppService
 */
class Smpp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SmppService::class;
    }
}
