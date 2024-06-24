<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Contracts\Translator;

abstract class Integration implements Translator
{
    protected array $map = [];

    abstract protected function translate(
        iterable|string $text,
        Locale|string $to,
        Locale|string|null $from
    ): Collection;

    public function can(string|Locale $to): bool
    {
        return $this->lang($to) !== null;
    }

    public function text(
        array|string $text,
        Locale|string $to,
        Locale|string|null $from = null
    ): array|string {
        return is_array($text)
            ? $this->translate($text, $to, $from)->pluck('text')->all()
            : $this->translate($text, $to, $from)->pluck('text')->first();
    }

    protected function lang(Locale|string|null $lang): ?string
    {
        $lang = $lang?->value ?? $lang;

        if (empty($lang)) {
            return null;
        }

        if ($value = $this->map[$lang] ?? false) {
            return $value;
        }

        if (in_array($lang, $this->map, true)) {
            return $lang;
        }

        return null;
    }
}
