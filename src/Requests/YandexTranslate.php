<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Requests;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use LaravelLang\LocaleList\Locale;

class YandexTranslate
{
    protected string $url = 'https://translate.api.cloud.yandex.net/translate/v2/translate';

    protected string $format = 'PLAIN_TEXT';

    public function __construct(
        protected string $key,
        protected string $folder,
    ) {}

    public function translate(iterable|string $text, Locale|string $to, Locale|string|null $from): array
    {
        return $this->request($this->resolveText($text), $to, $from)->json('translations');
    }

    protected function request(array $text, string $to, ?string $from): Response
    {
        return Http::acceptJson()
            ->asJson()
            ->withHeader('Authorization', 'Bearer ' . $this->key)
            ->throw()
            ->post($this->url, $this->body($text, $to, $from))
            ->throw();
    }

    protected function body(array $texts, string $to, ?string $from): array
    {
        return collect([
            'folderId' => $this->folder,
            'format'   => $this->format,
            'texts'    => $texts,
            'speller'  => true,

            'targetLanguageCode' => $to,
        ])->when($from, fn (Collection $items) => $items->put('sourceLanguageCode', $from))->all();
    }

    protected function resolveText(iterable|string $text): array
    {
        return collect($text)->all();
    }
}
