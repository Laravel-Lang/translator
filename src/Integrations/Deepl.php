<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use DeepL\Translator as DeeplTranslator;
use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;

class Deepl extends Integration
{
    protected array $map = [
        Locale::French->value => 'fr',
    ];

    public function __construct(
        protected DeeplTranslator $translator
    ) {}

    protected function request(iterable|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($this->translator->translateText($text, $this->lang($from), $this->lang($to)));
    }
}
