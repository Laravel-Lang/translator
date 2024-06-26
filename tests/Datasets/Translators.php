<?php

declare(strict_types=1);

use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\GoogleFree;
use LaravelLang\Translator\Integrations\Yandex;

dataset('translators', fn () => [
    Deepl::class      => [Deepl::class],
    GoogleFree::class => [GoogleFree::class],
    Yandex::class     => [Yandex::class],
]);
