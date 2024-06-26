<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Google extends Integration
{
    public static string $integration = GoogleTranslate::class;

    protected array $map = [
        Locale::French->value => 'fr',
    ];

    public function __construct(
        protected GoogleTranslate $translator,
        protected string|bool $regex = true
    ) {}

    protected function request(iterable|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($text)->map(
            fn (string $value) => $this->translator($to, $from)->translate($value)
        );
    }

    protected function translator(Locale|string $to, Locale|string|null $from): GoogleTranslate
    {
        return $this->translator
            ->preserveParameters($this->regex)
            ->setSource($this->locale($from))
            ->setTarget($this->locale($to));
    }
}
