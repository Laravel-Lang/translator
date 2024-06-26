<?php

declare(strict_types=1);

use DeepL\Translator as DeeplTranslate;
use Illuminate\Support\Arr;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;
use LaravelLang\Translator\Requests\YandexCloud as YandexTranslate;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Tests\Constants\Value;

function mockTranslators(array|string|null $text = null): void
{
    mockDeeplTranslator($text);
    mockGoogleTranslator($text);
    mockYandexTranslator($text);
}

function mockDeeplTranslator(array|string|null $text = null): void
{
    $mock = mock(DeeplTranslate::class);

    $mock->shouldReceive('translateText')->andReturn($text ?? Value::Text1French);

    mockTranslator(Deepl::class, $mock);
}

function mockGoogleTranslator(array|string|null $text = null): void
{
    $mock = mock(GoogleTranslate::class);

    $mock->shouldReceive('preserveParameters', 'setSource', 'setTarget')->andReturnSelf();

    is_array($text)
        ? $mock->shouldReceive('translate')->andReturn(...$text)
        : $mock->shouldReceive('translate')->andReturn($text ?? Value::Text1French);

    mockTranslator(Google::class, $mock);
}

function mockYandexTranslator(array|string|null $text = null): void
{
    $mock = mock(YandexTranslate::class);

    $mock->shouldReceive('translate')->andReturn(
        Arr::wrap($text ?? [Value::Text1French])
    );

    mockTranslator(Yandex::class, $mock);
}

function mockTranslator(string $translator, mixed $mock): void
{
    app()->forgetInstance($translator);
    app()->singleton($translator, fn () => new $translator($mock));
}
