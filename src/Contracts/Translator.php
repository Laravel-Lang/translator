<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Contracts;

use LaravelLang\LocaleList\Locale;

interface Translator
{
    public function can(Locale|string $to): bool;

    public function translate(
        bool|float|int|iterable|string|null $text,
        Locale|string|null $to,
        Locale|string|null $from = null
    ): array|bool|float|int|string|null;
}
