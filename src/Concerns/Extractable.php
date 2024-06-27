<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Concerns;

use LaravelLang\Translator\Services\Parameters;

trait Extractable
{
    /** @var array<Parameters> */
    protected array $parameters = [];

    protected function extractParameters(iterable|string $text): array|string
    {
        if (is_string($text)) {
            $service = Parameters::make();

            $result = $service->extract($text);

            $this->setParameter($text, $service);

            return $result;
        }

        return collect($text)->map(
            fn (string $value) => $this->extractParameters($value)
        )->all();
    }

    protected function injectParameters(iterable|string $hash, iterable|string $translated): array|string
    {
        if (is_string($hash)) {
            return $this->getParameter($hash)?->inject($translated) ?? $translated;
        }

        return collect($translated)->map(
            fn (string $text, mixed $key) => $this->getParameter($hash[$key])?->inject($text) ?? $text
        )->all();
    }

    protected function getParameter(string $key): ?Parameters
    {
        return $this->parameters[md5($key)] ?? null;
    }

    protected function setParameter(string $key, Parameters $parameters): void
    {
        $this->parameters[md5($key)] = $parameters;
    }
}
