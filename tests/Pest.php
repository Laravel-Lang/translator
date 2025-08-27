<?php

declare(strict_types=1);

uses(Tests\TestCase::class)
    ->compact()
    ->beforeEach(fn () => mockTranslators())
    ->in(__DIR__);
