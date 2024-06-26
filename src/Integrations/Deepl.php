<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use DeepL\Translator as DeeplTranslator;
use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;

class Deepl extends Integration
{
    public static string $integration = DeeplTranslator::class;

    protected array $map = [
        Locale::French->value => 'fr',
    ];

    public function __construct(
        protected DeeplTranslator $translator
    ) {}

    protected function request(iterable|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($this->translator->translateText($text, $this->locale($from), $this->locale($to)));
    }
}
