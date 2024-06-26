<?php

declare(strict_types=1);

use LaravelLang\LocaleList\Locale;

test('can be translatable', function (string $translator) {
    $translator = translator($translator);

    expect($translator->can('fr'))->toBeTrue();
    expect($translator->can(Locale::French))->toBeTrue();
})->with('translators');

test('cannot be translatable', function (string $translator) {
    $translator = translator($translator);

    expect($translator->can('qwerty'))->toBeFalse();
})->with('translators');
