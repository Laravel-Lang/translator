<?php

declare(strict_types=1);

use DeepL\TextResult;
use Illuminate\Support\Arr;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Integrations\Deepl;
use LaravelLang\Translator\Integrations\Google;
use LaravelLang\Translator\Integrations\Yandex;
use Tests\Constants\Value;

function mockTranslators(array|float|int|string|null $text = null): void
{
    mockDeeplTranslator($text);
    mockGoogleTranslator($text);
    mockYandexTranslator($text);
}

function mockDeeplTranslator(array|float|int|string|null $text = null): void
{
    $mock = mock(Deepl::$integration);

    $text ??= Value::Text1French;

    $result = fn (float|int|string|null $text) => new TextResult((string) $text, 'fr');

    $values = is_array($text) ? array_map(fn (float|int|string|null $value) => $result($value), $text) : $result($text);

    $mock->shouldReceive('translateText')->andReturn($values);

    mockTranslator(Deepl::class, $mock);
}

function mockGoogleTranslator(array|float|int|string|null $text = null): void
{
    $mock = mock(Google::$integration);

    $mock->shouldReceive('setSource', 'setTarget')->andReturnSelf();

    is_array($text)
        ? $mock->shouldReceive('translate')->andReturn(...$text)
        : $mock->shouldReceive('translate')->andReturn($text ?? Value::Text1French);

    mockTranslator(Google::class, $mock);
}

function mockYandexTranslator(array|float|int|string|null $text = null): void
{
    $mock = mock(Yandex::$integration);

    $values = Arr::wrap($text ?? [Value::Text1French]);

    $mock->shouldReceive('translate')->andReturn(array_map(fn (array|string $text) => [
        'text'                 => $text,
        'detectedLanguageCode' => Locale::French->value,
    ], $values));

    mockTranslator(Yandex::class, $mock);
}

function mockTranslator(string $translator, mixed $mock): void
{
    app()->forgetInstance($translator);
    app()->singleton($translator, fn () => new $translator($mock));
}
