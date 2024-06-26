<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Contracts\Translator;

abstract class Integration implements Translator
{
    protected array $map = [];

    abstract protected function request(
        iterable|string $text,
        Locale|string $to,
        Locale|string|null $from
    ): Collection;

    public function can(Locale|string $to): bool
    {
        return $this->lang($to) !== null;
    }

    public function translate(
        array|string $text,
        Locale|string $to,
        Locale|string|null $from = null
    ): array|string {
        return is_array($text)
            ? $this->request($text, $to, $from)->all()
            : $this->request($text, $to, $from)->first();
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
