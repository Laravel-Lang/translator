<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Services;

use Illuminate\Support\Str;
use LaravelLang\Config\Data\Shared\Translators\TranslatorData;
use LaravelLang\Config\Facades\Config;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Contracts\Translator;
use RuntimeException;

/**
 * @method array|string|int|float|bool|null viaDeepl(iterable|string $text, Locale|string $to, Locale|string|null $from = null)
 * @method array|string|int|float|bool|null viaGoogle(iterable|string $text, Locale|string $to, Locale|string|null $from = null)
 * @method array|string|int|float|bool|null viaYandex(iterable|string $text, Locale|string $to, Locale|string|null $from = null)
 */
class Translate
{
    public function text(
        bool|float|int|iterable|string|null $text,
        Locale|string $to,
        Locale|string|null $from = null
    ): array|bool|float|int|string|null {
        foreach ($this->translators() as $service) {
            if ($translated = $this->translate($service->translator, $text, $to, $from)) {
                return $translated;
            }
        }

        return $text;
    }

    public function __call(string $name, array $arguments): array|bool|float|int|string|null
    {
        if (Str::startsWith($name, 'via')) {
            $provider = Str::of($name)->substr(3)->lower()->toString();

            return $this->via($this->translators()[$provider]->translator, ...$arguments);
        }

        throw new RuntimeException("Undefined method called `$name`.");
    }

    protected function via(
        string $translator,
        bool|float|int|iterable|string|null $text,
        Locale|string $to,
        Locale|string|null $from = null
    ): array|bool|float|int|string|null {
        return $this->translate($translator, $text, $to, $from) ?: $text;
    }

    protected function translate(
        string $translator,
        bool|float|int|iterable|string|null $text,
        Locale|string $to,
        Locale|string|null $from = null
    ): array|bool|float|int|string|null {
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
