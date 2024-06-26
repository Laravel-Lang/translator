<?php

declare(strict_types=1);

use Tests\Concerns\Value;

test('as string', function (string $translator) {
    $translator = translator($translator);

    expect(
        $translator->translate(Value::Text1English, 'qwerty')
    )->toBe(Value::Text1English);
})->with('translators');

test('as array without keys', function (string $translator) {
    $translator = translator($translator);

    expect($translator->translate([Value::Text1English, Value::Text2English], 'qwerty'))->toBe([
        Value::Text1English,
        Value::Text2English,
    ]);
})->with('translators');

test('as array with keys', function (string $translator) {
    $translator = translator($translator);

    expect($translator->translate([
        'foo' => Value::Text1English,
        'bar' => Value::Text2English,
    ], 'qwerty'))->toBe([
        'foo' => Value::Text1English,
        'bar' => Value::Text2English,
    ]);
})->with('translators');

test('as collection', function (string $translator) {
    $translator = translator($translator);

    expect($translator->translate(collect([
        'foo' => Value::Text1English,
        'bar' => Value::Text2English,
    ]), 'qwerty'))->toBe([
        'foo' => Value::Text1English,
        'bar' => Value::Text2English,
    ]);
})->with('translators');
