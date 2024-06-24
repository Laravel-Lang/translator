<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Requests\YandexCloud;

class Yandex extends Integration
{
    protected array $map = [
        Locale::French->value => 'fr',
    ];

    public function __construct(
        protected YandexCloud $translator,
    ) {}

    protected function translate(iterable|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($this->translator->translate($text, $this->lang($to), $this->lang($from)));
    }
}
