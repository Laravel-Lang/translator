<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Requests\YandexTranslate;

class Yandex extends Integration
{
    protected array $map = [
        Locale::French->value => 'fr',
    ];

    public static string $integration = YandexTranslate::class;

    public function __construct(
        protected YandexTranslate $translator,
    ) {}

    protected function request(array|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($this->translator->translate($text, $this->locale($to), $this->locale($from)))->map(
            fn (array $item) => $item['text']
        );
    }
}
