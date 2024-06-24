<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Contracts;

use LaravelLang\LocaleList\Locale;

interface Translator
{
    public function can(Locale|string $to): bool;

    public function text(array|string $text, Locale|string $to, Locale|string|null $from = null): array|string;
}
