<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Facades;

use Illuminate\Support\Facades\Facade;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Services\Translate as Service;

/**
 * @method static array|string|int|float|bool|null text(iterable|string|int|float|bool|null $text, Locale|string $to, Locale|string|null $from = null)
 * @method static array|string|int|float|bool|null viaDeepl(iterable|string|int|float|bool|null $text, Locale|string $to, Locale|string|null $from = null)
 * @method static array|string|int|float|bool|null viaGoogle(iterable|string|int|float|bool|null $text, Locale|string $to, Locale|string|null $from = null)
 * @method static array|string|int|float|bool|null viaYandex(iterable|string|int|float|bool|null $text, Locale|string $to, Locale|string|null $from = null)
 */
class Translate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Service::class;
    }
}
