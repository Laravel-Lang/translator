<?php

declare(strict_types=1);

use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;

dataset('translators', fn () => [
    class_basename(Deepl::class)  => [Deepl::class],
    class_basename(Google::class) => [Google::class],
    class_basename(Yandex::class) => [Yandex::class],
]);
