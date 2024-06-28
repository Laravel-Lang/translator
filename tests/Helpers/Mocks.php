<?php

declare(strict_types=1);

use DeepL\TextResult;
use Illuminate\Support\Arr;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;
use Tests\Constants\Value;

function mockTranslators(array|string|null $text = null): void
{
    mockDeeplTranslator($text);
    mockGoogleTranslator($text);
    mockYandexTranslator($text);
}

function mockDeeplTranslator(array|string|null $text = null): void
{
    $mock = mock(Deepl::$integration);

    $text ??= Value::Text1French;

    $result = fn (?string $text) => new TextResult($text, 'fr');

    $values = is_array($text) ? array_map(fn (string $value) => $result($value), $text) : $result($text);

    $mock->shouldReceive('translateText')->andReturn($values);

    mockTranslator(Deepl::class, $mock);
}

function mockGoogleTranslator(array|string|null $text = null): void
{
    $mock = mock(Google::$integration);

    $mock->shouldReceive('setSource', 'setTarget')->andReturnSelf();

    is_array($text)
        ? $mock->shouldReceive('translate')->andReturn(...$text)
        : $mock->shouldReceive('translate')->andReturn($text ?? Value::Text1French);

    mockTranslator(Google::class, $mock);
}

function mockYandexTranslator(array|string|null $text = null): void
{
    $mock = mock(Yandex::$integration);

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
