<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Requests\GoogleTranslate;

class Google extends Integration
{
    /**
     * @see https://cloud.google.com/translate/docs/languages
     *
     * @var array<string>
     */
    protected array $map = [
        Locale::Afrikaans->value         => 'af',
        Locale::Albanian->value          => 'sq',
        Locale::Amharic->value           => 'am',
        Locale::Arabic->value            => 'ar',
        Locale::Armenian->value          => 'hy',
        Locale::Assamese->value          => 'as',
        Locale::Azerbaijani->value       => 'az',
        Locale::Bambara->value           => 'bm',
        Locale::Basque->value            => 'eu',
        Locale::Belarusian->value        => 'be',
        Locale::Bengali->value           => 'bn',
        Locale::Bhojpuri->value          => 'bho',
        Locale::Bosnian->value           => 'bs',
        Locale::Bulgarian->value         => 'bg',
        Locale::Catalan->value           => 'ca',
        Locale::Cebuano->value           => 'ceb',
        Locale::CentralKhmer->value      => 'km',
        Locale::Chinese->value           => 'zh-CN',
        Locale::ChineseHongKong->value   => 'zh',
        Locale::ChineseT->value          => 'zh-TW',
        Locale::Croatian->value          => 'hr',
        Locale::Czech->value             => 'cs',
        Locale::Danish->value            => 'da',
        Locale::Dogri->value             => 'doi',
        Locale::Dutch->value             => 'nl',
        Locale::Esperanto->value         => 'eo',
        Locale::Estonian->value          => 'et',
        Locale::Ewe->value               => 'ee',
        Locale::Finnish->value           => 'fi',
        Locale::French->value            => 'fr',
        Locale::Frisian->value           => 'fy',
        Locale::Galician->value          => 'gl',
        Locale::Georgian->value          => 'ka',
        Locale::German->value            => 'de',
        Locale::GermanSwitzerland->value => 'de',
        Locale::Greek->value             => 'el',
        Locale::Gujarati->value          => 'gu',
        Locale::Hausa->value             => 'ha',
        Locale::Hawaiian->value          => 'haw',
        Locale::Hebrew->value            => 'he',
        Locale::Hindi->value             => 'hi',
        Locale::Hungarian->value         => 'hu',
        Locale::Icelandic->value         => 'is',
        Locale::Igbo->value              => 'ig',
        Locale::Indonesian->value        => 'id',
        Locale::Irish->value             => 'ga',
        Locale::Italian->value           => 'it',
        Locale::Japanese->value          => 'ja',
        Locale::Kannada->value           => 'kn',
        Locale::Kazakh->value            => 'kk',
        Locale::Kinyarwanda->value       => 'rw',
        Locale::Korean->value            => 'ko',
        Locale::Kurdish->value           => 'ku',
        Locale::KurdishSorani->value     => 'ckb',
        Locale::Kyrgyz->value            => 'ky',
        Locale::Lao->value               => 'lo',
        Locale::Latvian->value           => 'lv',
        Locale::Lingala->value           => 'ln',
        Locale::Lithuanian->value        => 'lt',
        Locale::Luganda->value           => 'lg',
        Locale::Luxembourgish->value     => 'lb',
        Locale::Macedonian->value        => 'mk',
        Locale::Maithili->value          => 'mai',
        Locale::Malagasy->value          => 'mg',
        Locale::Malay->value             => 'ms',
        Locale::Malayalam->value         => 'ml',
        Locale::Maltese->value           => 'mt',
        Locale::Maori->value             => 'mi',
        Locale::Marathi->value           => 'mr',
        Locale::MeiteilonManipuri->value => 'mni-Mtei',
        Locale::Mongolian->value         => 'mn',
        Locale::MyanmarBurmese->value    => 'my',
        Locale::Nepali->value            => 'ne',
        Locale::NorwegianBokmal->value   => 'no',
        Locale::NorwegianNynorsk->value  => 'no',
        Locale::OdiaOriya->value         => 'or',
        Locale::Oromo->value             => 'om',
        Locale::Pashto->value            => 'ps',
        Locale::Persian->value           => 'fa',
        Locale::Pilipino->value          => 'fil',
        Locale::Polish->value            => 'pl',
        Locale::Portuguese->value        => 'pt',
        Locale::PortugueseBrazil->value  => 'pt',
        Locale::Punjabi->value           => 'pa',
        Locale::Quechua->value           => 'qu',
        Locale::Romanian->value          => 'ro',
        Locale::Russian->value           => 'ru',
        Locale::Sanskrit->value          => 'sa',
        Locale::ScotsGaelic->value       => 'gd',
        Locale::SerbianCyrillic->value   => 'sr',
        Locale::Shona->value             => 'sn',
        Locale::Sindhi->value            => 'sd',
        Locale::Sinhala->value           => 'si',
        Locale::Slovak->value            => 'sk',
        Locale::Slovenian->value         => 'sl',
        Locale::Somali->value            => 'so',
        Locale::Spanish->value           => 'es',
        Locale::Sundanese->value         => 'su',
        Locale::Swahili->value           => 'sw',
        Locale::Swedish->value           => 'sv',
        Locale::Tagalog->value           => 'tl',
        Locale::Tajik->value             => 'tg',
        Locale::Tamil->value             => 'ta',
        Locale::Tatar->value             => 'tt',
        Locale::Telugu->value            => 'te',
        Locale::Thai->value              => 'th',
        Locale::Tigrinya->value          => 'ti',
        Locale::Turkish->value           => 'tr',
        Locale::Turkmen->value           => 'tk',
        Locale::TwiAkan->value           => 'ak',
        Locale::Uighur->value            => 'ug',
        Locale::Ukrainian->value         => 'uk',
        Locale::Urdu->value              => 'ur',
        Locale::UzbekCyrillic->value     => 'uz',
        Locale::Vietnamese->value        => 'vi',
        Locale::Welsh->value             => 'cy',
        Locale::Xhosa->value             => 'xh',
        Locale::Yiddish->value           => 'yi',
        Locale::Yoruba->value            => 'yo',
        Locale::Zulu->value              => 'zu',
    ];

    public static string $integration = GoogleTranslate::class;

    public function __construct(
        protected GoogleTranslate $translator,
    ) {}

    protected function request(array|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        return collect($text)->map(
            fn (string $value) => $this->translator($to, $from)->translate($value)
        );
    }

    protected function translator(Locale|string $to, Locale|string|null $from): GoogleTranslate
    {
        return $this->translator
            ->setSource($this->locale($from))
            ->setTarget($this->locale($to));
    }
}
