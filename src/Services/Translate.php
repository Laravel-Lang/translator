<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Services;

use LaravelLang\Config\Data\Shared\Translators\TranslatorData;
use LaravelLang\Config\Facades\Config;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Contracts\Translator;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;

class Translate
{
    public function text(iterable|string $text, Locale|string $to, Locale|string|null $from = null): array|string
    {
        foreach ($this->translators() as $service) {
            if ($translated = $this->translate($service->translator, $text, $to, $from)) {
                return $translated;
            }
        }

        return $text;
    }

    public function viaDeepl(iterable|string $text, Locale|string $to, Locale|string|null $from = null): array|string
    {
        return $this->via(Deepl::class, $text, $to, $from);
    }

    public function viaGoogle(iterable|string $text, Locale|string $to, Locale|string|null $from = null): array|string
    {
        return $this->via(Google::class, $text, $to, $from);
    }

    public function viaYandex(iterable|string $text, Locale|string $to, Locale|string|null $from = null): array|string
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
            return $translator->translate($text, $to, $from);
        }

        return null;
    }

    /**
     * @return array<TranslatorData>
     */
    protected function translators(): array
    {
        return Config::shared()->translators->channels->enabled;
    }

    protected function initialize(string $class): Translator
    {
        return app(ltrim($class, '\\'));
    }
}
