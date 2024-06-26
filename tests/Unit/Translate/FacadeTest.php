<?php

declare(strict_types=1);

use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Facades\Translate;
use Tests\Concerns\Value;

test('translate', function () {
    expect(Translate::text(Value::Text1English, Locale::French))->toBe(
        Value::Text1French
    );
});

test('cannot be translated', function () {
    expect(Translate::text(Value::Text1English, 'qwerty'))->toBe(
        Value::Text1English
    );
});

test('via deepl', function () {
    expect(Translate::viaDeepl(Value::Text1English, Locale::French))->toBe(
        Value::Text1French
    );
});

test('via google free', function () {
    expect(Translate::viaGoogleFree(Value::Text1English, Locale::French))->toBe(
        Value::Text1French
    );
});

test('via yandex', function () {
    expect(Translate::viaYandex(Value::Text1English, Locale::French))->toBe(
        Value::Text1French
    );
});
