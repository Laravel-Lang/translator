<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Requests;

use DeepL\Translator as DeeplTranslator;

class DeeplTranslate extends DeeplTranslator
{
    public function __construct(
        string $key
    ) {
        parent::__construct($key);
    }
}
