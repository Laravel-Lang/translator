<?php

declare(strict_types=1);

use LaravelLang\Translator\Contracts\Translator;

function translator(string $class): Translator
{
    return app($class);
}
