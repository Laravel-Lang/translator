<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Requests;

use Stichoza\GoogleTranslate\GoogleTranslate as BaseTranslate;

class GoogleTranslate extends BaseTranslate
{
    /**
     * Extract replaceable keywords from string using the supplied pattern.
     */
    protected function extractParameters(string $string): string
    {
        if (! $this->pattern) {
            return $string;
        }

        return preg_replace_callback(
            $this->pattern,
            function ($matches) {
                static $index = -1;

                ++$index;

                return '{' . $index . '}';
            },
            $string
        );
    }

    /**
     * Inject the replacements back into the translated string.
     *
     * @param  array<string>  $replacements
     */
    protected function injectParameters(string $string, array $replacements): string
    {
        return preg_replace_callback(
            '/\{(\d+)}/',
            fn ($matches) => $replacements[$matches[1]],
            $string
        );
    }
}
