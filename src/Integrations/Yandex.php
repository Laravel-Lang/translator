<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Requests\YandexCloud;

class Yandex extends Integration
{
    public static string $integration = YandexCloud::class;

    protected array $map = [
        Locale::French->value => 'fr',
    ];

    public function __construct(
        protected YandexCloud $translator,
    ) {}

    protected function request(iterable|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($this->translator->translate($text, $this->locale($to), $this->locale($from)));
    }
}
