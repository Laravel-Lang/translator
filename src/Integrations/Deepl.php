<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use DeepL\LanguageCode;
use DeepL\TextResult;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Requests\DeeplTranslate;

class Deepl extends Integration
{
    /**
     * @see https://www.deepl.com/ru/translator
     *
     * @var array<string>
     */
    protected array $map = [
        Locale::Arabic->value            => LanguageCode::ARABIC,
        Locale::Bulgarian->value         => LanguageCode::BULGARIAN,
        Locale::Chinese->value           => LanguageCode::CHINESE,
        Locale::ChineseHongKong->value   => LanguageCode::CHINESE,
        Locale::Czech->value             => LanguageCode::CZECH,
        Locale::Danish->value            => LanguageCode::DANISH,
        Locale::Dutch->value             => LanguageCode::DUTCH,
        Locale::English->value           => LanguageCode::ENGLISH,
        Locale::Estonian->value          => LanguageCode::ESTONIAN,
        Locale::Finnish->value           => LanguageCode::FINNISH,
        Locale::French->value            => LanguageCode::FRENCH,
        Locale::German->value            => LanguageCode::GERMAN,
        Locale::GermanSwitzerland->value => LanguageCode::GERMAN,
        Locale::Greek->value             => LanguageCode::GREEK,
        Locale::Hungarian->value         => LanguageCode::HUNGARIAN,
        Locale::Indonesian->value        => LanguageCode::INDONESIAN,
        Locale::Italian->value           => LanguageCode::ITALIAN,
        Locale::Japanese->value          => LanguageCode::JAPANESE,
        Locale::Korean->value            => LanguageCode::KOREAN,
        Locale::Latvian->value           => LanguageCode::LATVIAN,
        Locale::Lithuanian->value        => LanguageCode::LITHUANIAN,
        Locale::NorwegianBokmal->value   => LanguageCode::NORWEGIAN,
        Locale::NorwegianNynorsk->value  => LanguageCode::NORWEGIAN,
        Locale::Polish->value            => LanguageCode::POLISH,
        Locale::Portuguese->value        => LanguageCode::PORTUGUESE,
        Locale::PortugueseBrazil->value  => LanguageCode::PORTUGUESE_BRAZILIAN,
        Locale::Romanian->value          => LanguageCode::ROMANIAN,
        Locale::Russian->value           => LanguageCode::RUSSIAN,
        Locale::Slovak->value            => LanguageCode::SLOVAK,
        Locale::Slovenian->value         => LanguageCode::SLOVENIAN,
        Locale::Spanish->value           => LanguageCode::SPANISH,
        Locale::Swedish->value           => LanguageCode::SWEDISH,
        Locale::Turkish->value           => LanguageCode::TURKISH,
        Locale::Ukrainian->value         => LanguageCode::UKRAINIAN,
        // Locale::Afrikaans->value          => 'af',
        // Locale::Albanian->value           => 'sq',
        // Locale::Amharic->value            => 'am',
        // Locale::Armenian->value           => 'hy',
        // Locale::Assamese->value           => 'as',
        // Locale::Azerbaijani->value        => 'az',
        // Locale::Bambara->value            => 'bm',
        // Locale::Basque->value             => 'eu',
        // Locale::Belarusian->value         => 'be',
        // Locale::Bengali->value            => 'bn',
        // Locale::Bhojpuri->value           => 'bho',
        // Locale::Bosnian->value            => 'bs',
        // Locale::Catalan->value            => 'ca',
        // Locale::Cebuano->value            => 'ceb',
        // Locale::CentralKhmer->value       => 'km',
        // Locale::ChineseT->value           => 'zh_TW',
        // Locale::Croatian->value           => 'hr',
        // Locale::Dogri->value              => 'doi',
        // Locale::Esperanto->value          => 'eo',
        // Locale::Ewe->value                => 'ee',
        // Locale::Frisian->value            => 'fy',
        // Locale::Galician->value           => 'gl',
        // Locale::Georgian->value           => 'ka',
        // Locale::Gujarati->value           => 'gu',
        // Locale::Hausa->value              => 'ha',
        // Locale::Hawaiian->value           => 'haw',
        // Locale::Hebrew->value             => 'he',
        // Locale::Hindi->value              => 'hi',
        // Locale::Icelandic->value          => 'is',
        // Locale::Igbo->value               => 'ig',
        // Locale::Irish->value              => 'ga',
        // Locale::Kannada->value            => 'kn',
        // Locale::Kazakh->value             => 'kk',
        // Locale::Kinyarwanda->value        => 'rw',
        // Locale::Kurdish->value            => 'ku',
        // Locale::KurdishSorani->value      => 'ckb',
        // Locale::Kyrgyz->value             => 'ky',
        // Locale::Lao->value                => 'lo',
        // Locale::Lingala->value            => 'ln',
        // Locale::Luganda->value            => 'lg',
        // Locale::Luxembourgish->value      => 'lb',
        // Locale::Macedonian->value         => 'mk',
        // Locale::Maithili->value           => 'mai',
        // Locale::Malagasy->value           => 'mg',
        // Locale::Malay->value              => 'ms',
        // Locale::Malayalam->value          => 'ml',
        // Locale::Maltese->value            => 'mt',
        // Locale::Maori->value              => 'mi',
        // Locale::Marathi->value            => 'mr',
        // Locale::MeiteilonManipuri->value  => 'mni_Mtei',
        // Locale::Mongolian->value          => 'mn',
        // Locale::MyanmarBurmese->value     => 'my',
        // Locale::Nepali->value             => 'ne',
        // Locale::Occitan->value            => 'oc',
        // Locale::OdiaOriya->value          => 'or',
        // Locale::Oromo->value              => 'om',
        // Locale::Pashto->value             => 'ps',
        // Locale::Persian->value            => 'fa',
        // Locale::Pilipino->value           => 'fil',
        // Locale::Punjabi->value            => 'pa',
        // Locale::Quechua->value            => 'qu',
        // Locale::Sanskrit->value           => 'sa',
        // Locale::Sardinian->value          => 'sc',
        // Locale::ScotsGaelic->value        => 'gd',
        // Locale::SerbianCyrillic->value    => 'sr_Cyrl',
        // Locale::SerbianLatin->value       => 'sr_Latn',
        // Locale::SerbianMontenegrin->value => 'sr_Latn_ME',
        // Locale::Shona->value              => 'sn',
        // Locale::Sindhi->value             => 'sd',
        // Locale::Sinhala->value            => 'si',
        // Locale::Somali->value             => 'so',
        // Locale::Sundanese->value          => 'su',
        // Locale::Swahili->value            => 'sw',
        // Locale::Tagalog->value            => 'tl',
        // Locale::Tajik->value              => 'tg',
        // Locale::Tamil->value              => 'ta',
        // Locale::Tatar->value              => 'tt',
        // Locale::Telugu->value             => 'te',
        // Locale::Thai->value               => 'th',
        // Locale::Tigrinya->value           => 'ti',
        // Locale::Turkmen->value            => 'tk',
        // Locale::TwiAkan->value            => 'ak',
        // Locale::Uighur->value             => 'ug',
        // Locale::Urdu->value               => 'ur',
        // Locale::UzbekCyrillic->value      => 'uz_Cyrl',
        // Locale::UzbekLatin->value         => 'uz_Latn',
        // Locale::Vietnamese->value         => 'vi',
        // Locale::Welsh->value              => 'cy',
        // Locale::Xhosa->value              => 'xh',
        // Locale::Yiddish->value            => 'yi',
        // Locale::Yoruba->value             => 'yo',
        // Locale::Zulu->value               => 'zu',
    ];

    public static string $integration = DeeplTranslate::class;

    public function __construct(
        protected DeeplTranslate $translator
    ) {}

    protected function request(array|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        $translated = $this->translator->translateText($text, $this->locale($from), $this->locale($to));

        return collect(Arr::wrap($translated))->map(
            fn (TextResult $result) => $result->text
        );
    }
}
