<?php

declare(strict_types=1);

use LaravelLang\Translator\Services\Parameters;

test('extract', function (mixed $source, mixed $target, array $extracts) {
    $service = Parameters::make();

    $extracted = $service->extract($source);

    expect($extracted)->toBe($target);

    expect($service->inject($extracted))->toBe($source);

    expect($service->extracted())->toBe($extracts);
})->with('translatable-with-parameters');
