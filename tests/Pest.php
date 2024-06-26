<?php

uses(Tests\TestCase::class)
    ->compact()
    ->beforeEach(fn () => mockTranslators())
    ->in(__DIR__);
