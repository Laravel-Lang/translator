<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Concerns\Extractable;
use LaravelLang\Translator\Contracts\Translator;

abstract class Integration implements Translator
{
    use Extractable;

    public static string $integration;

    protected array $map = [];

    abstract protected function request(
        array|string $text,
        Locale|string $to,
        Locale|string|null $from
    ): Collection;

    public function can(Locale|string $to): bool
    {
        return $this->locale($to) !== null;
    }

    public function translate(
        iterable|string|int|float|bool|null $text,
        Locale|string|null $to,
        Locale|string|null $from = null
    ): array|string|int|float|bool|null {
        if (! is_iterable($text) && ! is_string($text)) {
            return $text;
        }

        if ($this->invalidLocale($to)) {
            return is_string($text) ? $text : collect($text)->all();
        }

        return is_iterable($text)
            ? $this->injectParameters($text, $this->request($this->extractParameters($text), $to, $from)->all())
            : $this->injectParameters($text, $this->request($this->extractParameters($text), $to, $from)->first());
    }

    protected function locale(Locale|string|null $locale): ?string
    {
        $locale = $locale?->value ?? $locale;

        if (empty($locale)) {
            return null;
        }

        if ($value = $this->map[$locale] ?? false) {
            return $value;
        }

        if (in_array($locale, $this->map, true)) {
            return $locale;
        }

        return null;
    }

    protected function invalidLocale(Locale|string|null $locale): bool
    {
        return ! $this->locale($locale);
    }
}
