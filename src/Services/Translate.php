<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Services;

use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Contracts\Translator;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\GoogleFree;
use LaravelLang\Translator\Integrations\Yandex;

class Translate
{
    public function text(iterable|string $text, Locale|string $to, Locale|string|null $from): array|string
    {
        foreach ($this->translators() as $class) {
            if ($translated = $this->translate($class, $text, $to, $from)) {
                return $translated;
            }
        }

        return $text;
    }

    public function viaDeepl(iterable|string $text, Locale|string $to, Locale|string|null $from): array|string
    {
        return $this->via(Deepl::class, $text, $to, $from);
    }

    public function viaGoogleFree(iterable|string $text, Locale|string $to, Locale|string|null $from): array|string
    {
        return $this->via(GoogleFree::class, $text, $to, $from);
    }

    public function viaYandex(iterable|string $text, Locale|string $to, Locale|string|null $from): array|string
    {
        return $this->via(Yandex::class, $text, $to, $from);
    }

    protected function via(
        string $translator,
        iterable|string $text,
        Locale|string $to,
        Locale|string|null $from
    ): array|string {
        return $this->translate($translator, $text, $to, $from) ?: $text;
    }

    protected function translate(
        string $translator,
        iterable|string $text,
        Locale|string $to,
        Locale|string|null $from
    ): array|string|null {
        $translator = $this->initialize($translator);

        if ($translator->can($to)) {
            return $translator->text($text, $to, $from);
        }

        return null;
    }

    protected function translators(): array
    {
        return config('localization.translators');
    }

    protected function initialize(string $class): Translator
    {
        return app($class);
    }
}
