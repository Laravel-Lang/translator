<?php

declare(strict_types=1);

use LaravelLang\LocaleList\Locale;
use Tests\Constants\Value;

test('as string', function (string $translator) {
    $translator = translator($translator);

    expect(
        $translator->translate(Value::Text1English, Locale::French)
    )->toBe(Value::Text1French);
})->with('translators');

test('as array without keys', function (string $translator) {
    $translator = translator($translator);

    expect($translator->translate([Value::Text1English, Value::Text2English], Locale::French))->toBe([
        Value::Text1French,
        Value::Text2French,
    ]);
})->with('translators');

test('as array with keys', function (string $translator) {
    $translator = translator($translator);

    expect($translator->translate([
        'foo' => Value::Text1English,
        'bar' => Value::Text2English,
    ], Locale::French))->toBe([
        'foo' => Value::Text1French,
        'bar' => Value::Text2French,
    ]);
})->with('translators');

test('as collection', function (string $translator) {
    $translator = translator($translator);

    expect($translator->translate(collect([
        'foo' => Value::Text1English,
        'bar' => Value::Text2English,
    ]), Locale::French))->toBe([
        'foo' => Value::Text1French,
        'bar' => Value::Text2French,
    ]);
})->with('translators');
