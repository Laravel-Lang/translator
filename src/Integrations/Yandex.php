<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Requests\YandexTranslate;

class Yandex extends Integration
{
    /**
     * @see https://yandex.cloud/en/docs/translate/concepts/supported-languages
     *
     * @var array<string>
     */
    protected array $map = [
        Locale::Afrikaans->value          => 'af',
        Locale::Albanian->value           => 'sq',
        Locale::Amharic->value            => 'am',
        Locale::Armenian->value           => 'hy',
        Locale::Azerbaijani->value        => 'az',
        Locale::Basque->value             => 'eu',
        Locale::Belarusian->value         => 'be',
        Locale::Bengali->value            => 'bn',
        Locale::Bosnian->value            => 'bs',
        Locale::Bulgarian->value          => 'bg',
        Locale::Catalan->value            => 'ca',
        Locale::Cebuano->value            => 'ceb',
        Locale::CentralKhmer->value       => 'km',
        Locale::Chinese->value            => 'zh',
        Locale::ChineseHongKong->value    => 'zh',
        Locale::Croatian->value           => 'hr',
        Locale::Czech->value              => 'cs',
        Locale::Danish->value             => 'da',
        Locale::Dutch->value              => 'nl',
        Locale::English->value            => 'en',
        Locale::Esperanto->value          => 'eo',
        Locale::Estonian->value           => 'et',
        Locale::Finnish->value            => 'fi',
        Locale::French->value             => 'fr',
        Locale::Galician->value           => 'gl',
        Locale::Georgian->value           => 'ka',
        Locale::German->value             => 'de',
        Locale::GermanSwitzerland->value  => 'de',
        Locale::Greek->value              => 'el',
        Locale::Gujarati->value           => 'gu',
        Locale::Hebrew->value             => 'he',
        Locale::Hindi->value              => 'hi',
        Locale::Hungarian->value          => 'hu',
        Locale::Icelandic->value          => 'is',
        Locale::Indonesian->value         => 'id',
        Locale::Irish->value              => 'ga',
        Locale::Italian->value            => 'it',
        Locale::Japanese->value           => 'ja',
        Locale::Kannada->value            => 'kn',
        Locale::Kazakh->value             => 'kk',
        Locale::Korean->value             => 'ko',
        Locale::Kyrgyz->value             => 'ky',
        Locale::Lao->value                => 'lo',
        Locale::Latvian->value            => 'lv',
        Locale::Lithuanian->value         => 'lt',
        Locale::Luxembourgish->value      => 'lb',
        Locale::Macedonian->value         => 'mk',
        Locale::Malagasy->value           => 'mg',
        Locale::Malay->value              => 'ms',
        Locale::Malayalam->value          => 'ml',
        Locale::Maltese->value            => 'mt',
        Locale::Maori->value              => 'mi',
        Locale::Marathi->value            => 'mr',
        Locale::Mongolian->value          => 'mn',
        Locale::MyanmarBurmese->value     => 'my',
        Locale::Nepali->value             => 'ne',
        Locale::NorwegianBokmal->value    => 'no',
        Locale::NorwegianNynorsk->value   => 'no',
        Locale::Persian->value            => 'fa',
        Locale::Polish->value             => 'pl',
        Locale::Portuguese->value         => 'pt',
        Locale::PortugueseBrazil->value   => 'pt-BR',
        Locale::Punjabi->value            => 'pa',
        Locale::Romanian->value           => 'ro',
        Locale::Russian->value            => 'ru',
        Locale::ScotsGaelic->value        => 'gd',
        Locale::SerbianCyrillic->value    => 'sr',
        Locale::SerbianLatin->value       => 'sr-Latn',
        Locale::SerbianMontenegrin->value => 'sr-Latn',
        Locale::Sinhala->value            => 'si',
        Locale::Slovak->value             => 'sk',
        Locale::Slovenian->value          => 'sl',
        Locale::Spanish->value            => 'es',
        Locale::Sundanese->value          => 'su',
        Locale::Swahili->value            => 'sw',
        Locale::Swedish->value            => 'sv',
        Locale::Tagalog->value            => 'tl',
        Locale::Tajik->value              => 'tg',
        Locale::Tamil->value              => 'ta',
        Locale::Tatar->value              => 'tt',
        Locale::Telugu->value             => 'te',
        Locale::Thai->value               => 'th',
        Locale::Turkish->value            => 'tr',
        Locale::Ukrainian->value          => 'uk',
        Locale::Urdu->value               => 'ur',
        Locale::UzbekCyrillic->value      => 'uzbcyr',
        Locale::UzbekLatin->value         => 'uz',
        Locale::Vietnamese->value         => 'vi',
        Locale::Welsh->value              => 'cy',
        Locale::Xhosa->value              => 'xh',
        Locale::Yiddish->value            => 'yi',
        Locale::Zulu->value               => 'zu',
        // Locale::Arabic->value             => 'ar',
        // Locale::Assamese->value           => 'as',
        // Locale::Bambara->value            => 'bm',
        // Locale::Bhojpuri->value           => 'bho',
        // Locale::ChineseT->value           => 'zh_TW',
        // Locale::Dogri->value              => 'doi',
        // Locale::Ewe->value                => 'ee',
        // Locale::Frisian->value            => 'fy',
        // Locale::Hausa->value              => 'ha',
        // Locale::Hawaiian->value           => 'haw',
        // Locale::Igbo->value               => 'ig',
        // Locale::Kinyarwanda->value        => 'rw',
        // Locale::Kurdish->value            => 'ku',
        // Locale::KurdishSorani->value      => 'ckb',
        // Locale::Lingala->value            => 'ln',
        // Locale::Luganda->value            => 'lg',
        // Locale::Maithili->value           => 'mai',
        // Locale::MeiteilonManipuri->value  => 'mni_Mtei',
        // Locale::Occitan->value            => 'oc',
        // Locale::OdiaOriya->value          => 'or',
        // Locale::Oromo->value              => 'om',
        // Locale::Pashto->value             => 'ps',
        // Locale::Pilipino->value           => 'fil',
        // Locale::Quechua->value            => 'qu',
        // Locale::Sanskrit->value           => 'sa',
        // Locale::Sardinian->value          => 'sc',
        // Locale::Shona->value              => 'sn',
        // Locale::Sindhi->value             => 'sd',
        // Locale::Somali->value             => 'so',
        // Locale::Tigrinya->value           => 'ti',
        // Locale::Turkmen->value            => 'tk',
        // Locale::TwiAkan->value            => 'ak',
        // Locale::Uighur->value             => 'ug',
        // Locale::Yoruba->value             => 'yo',
    ];

    public static string $integration = YandexTranslate::class;

    public function __construct(
        protected YandexTranslate $translator,
    ) {
    }

    protected function request(array|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($this->translator->translate($text, $this->locale($to), $this->locale($from)))->map(
            fn (array $item) => $item['text']
        );
    }
}
