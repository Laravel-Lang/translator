<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Requests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use LaravelLang\LocaleList\Locale;

class YandexCloud
{
    protected string $url = 'https://translate.api.cloud.yandex.net/translate/v2/translate';

    protected string $format = 'PLAIN_TEXT';

    public function __construct(
        protected string $key,
        protected string $folderId,
    ) {}

    public function translate(iterable|string $text, string|Locale $to, string|Locale|null $from): array
    {
        return $this->request($this->resolveText($text), $to, $from);
    }

    protected function request(array $text, ?string $to, ?string $from): array
    {
        return Http::acceptJson()
            ->asJson()
            ->withHeader('Authorization', 'Bearer ' . $this->key)
            ->throw()
            ->post($this->url, $this->body($text, $to, $from))
            ->throw()
            ->json();
    }

    protected function body(array $texts, ?string $to, ?string $from): array
    {
        return collect([
            'folderId' => $this->folderId,
            'format'   => $this->format,
            'texts'    => $texts,

            'targetLanguageCode' => $to,
        ])->when($from, fn (Collection $items) => $items->put('sourceLanguageCode', $from))->all();
    }

    protected function resolveText(iterable|string $text): array
    {
        return collect($text)->all();
    }
}
