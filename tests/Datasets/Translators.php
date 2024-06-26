<?php

declare(strict_types=1);

use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;

dataset('translators', fn () => [
    Deepl::class  => [Deepl::class],
    Google::class => [Google::class],
    Yandex::class => [Yandex::class],
]);
