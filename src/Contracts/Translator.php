<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Contracts;

use LaravelLang\LocaleList\Locale;

interface Translator
{
    public function can(Locale|string $to): bool;

    public function translate(
        iterable|string|int|float|bool|null $text,
        Locale|string|null $to,
        Locale|string|null $from = null
    ): array|string|int|float|bool|null;
}
