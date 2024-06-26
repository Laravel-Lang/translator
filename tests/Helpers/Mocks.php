<?php

declare(strict_types=1);

use DeepL\Translator as DeeplTranslator;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;
use LaravelLang\Translator\Requests\YandexCloud;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Tests\Constants\Value;

function mockTranslator(string $translator, string $integration, array $methods = []): void
{
    $service = mock($integration);

    foreach ($methods as $key => $value) {
        is_string($key)
            ? $service->shouldReceive($key)->andReturn($value)
            : $service->shouldReceive($value)->andReturnSelf();
    }

    app()->forgetInstance($translator);
    app()->singleton($translator, fn () => new $translator($service));
}

function mockTranslators(
    array|string|null $deepl = null,
    array|string|null $google = null,
    array|string|null $yandex = null,
): void {
    mockTranslator(Deepl::class, DeeplTranslator::class, [
        'translateText' => $deepl ?? Value::Text1French,
    ]);

    mockTranslator(Google::class, GoogleTranslate::class, [
        'translate' => $google ?? Value::Text1French,
        'preserveParameters',
        'setSource',
        'setTarget',
    ]);

    mockTranslator(Yandex::class, YandexCloud::class, [
        'translate' => $yandex ?? [Value::Text1French],
    ]);
}
