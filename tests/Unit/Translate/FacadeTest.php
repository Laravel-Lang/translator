<?php

declare(strict_types=1);

use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Facades\Translate;

test('translate', function (mixed $source, mixed $target) {
    mockTranslators($target);

    expect(Translate::text($source, Locale::French))->toBe($target);
})->with('translatable-mixed-values');

test('cannot be translated', function (mixed $source, mixed $target) {
    expect(Translate::text($source, 'qwerty'))->toBe($target);
})->with('translatable-mixed-values');

test('via deepl', function (mixed $source, mixed $target) {
    mockTranslators($target);

    expect(Translate::viaDeepl($source, Locale::French))->toBe($target);
})->with('translatable-mixed-values');

test('via google', function (mixed $source, mixed $target) {
    mockTranslators($target);

    expect(Translate::viaGoogle($source, Locale::French))->toBe($target);
})->with('translatable-mixed-values');

test('via yandex', function (mixed $source, mixed $target) {
    mockTranslators($target);

    expect(Translate::viaYandex($source, Locale::French))->toBe($target);
})->with('translatable-mixed-values');
