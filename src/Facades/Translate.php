<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Facades;

use Illuminate\Support\Facades\Facade;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Services\Translate as TranslateService;

/**
 * @method static array|string text(iterable|string $text, Locale|string $to, Locale|string|null $from = null)
 * @method static array|string viaDeepl(iterable|string $text, Locale|string $to, Locale|string|null $from = null)
 * @method static array|string viaGoogleFree(iterable|string $text, Locale|string $to, Locale|string|null $from = null)
 * @method static array|string viaYandex(iterable|string $text, Locale|string $to, Locale|string|null $from = null)
 */
class Translate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TranslateService::class;
    }
}
