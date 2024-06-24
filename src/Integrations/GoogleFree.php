<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleFree extends Integration
{
    protected array $map = [
        Locale::French->value => 'fr',
    ];

    public function __construct(
        protected GoogleTranslate $translator,
        protected array $options,
        protected bool|string $preserve
    ) {}

    protected function translate(iterable|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($text)->map(
            fn (string $value) => $this->translator($to, $from)->translate($value)
        );
    }

    protected function translator(Locale|string $to, Locale|string|null $from): GoogleTranslate
    {
        return $this->translator
            ->preserveParameters($this->preserve)
            ->setSource($this->lang($from))
            ->setTarget($this->lang($to))
            ->setOptions($this->options);
    }
}
