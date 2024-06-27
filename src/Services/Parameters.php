<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Services;

use DragonCode\Support\Concerns\Makeable;
use DragonCode\Support\Facades\Helpers\Str;
use LaravelLang\Config\Facades\Config;

class Parameters
{
    use Makeable;

    protected array $values = [];

    public function extract(float|int|string $text): float|int|string
    {
        if (! $pattern = $this->pattern()) {
            return $text;
        }

        if (is_numeric($text)) {
            return $text;
        }

        return preg_replace_callback($pattern, function (array $matches) {
            $index = count($this->values);

            $this->values[$index] = $matches[0];

            return '{' . $index . '}';
        }, $text);
    }

    public function inject(float|int|string $text): float|int|string
    {
        if (! $this->values || ! $this->pattern()) {
            return $text;
        }

        if (is_numeric($text)) {
            return $text;
        }

        return Str::replaceFormat($text, $this->values, '{%d}');
    }

    public function extracted(): array
    {
        return $this->values;
    }

    protected function pattern(): bool|string
    {
        $value = $this->preserveParameters();

        if (is_string($value)) {
            return $value;
        }

        if ($value === true) {
            return '/:(\w+)/';
        }

        return false;
    }

    protected function preserveParameters(): bool|string
    {
        return Config::shared()->translators->options->preserveParameters;
    }
}
