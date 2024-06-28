<?php

declare(strict_types=1);

namespace LaravelLang\Translator\Integrations;

use DeepL\LanguageCode;
use Illuminate\Support\Collection;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Requests\DeeplTranslate;

class Deepl extends Integration
{
    public static string $integration = DeeplTranslate::class;

    /**
     * @see https://www.deepl.com/ru/translator
     *
     * @var array<string>
     */
    protected array $map = [
        // Locale::Afrikaans->value         => 'af',
        // Locale::Albanian->value          => 'sq',
        Locale::Arabic->value            => LanguageCode::ARABIC,
        // Locale::Armenian->value          => 'hy',
        // Locale::Azerbaijani->value       => 'az',
        // Locale::Basque->value            => 'eu',
        // Locale::Belarusian->value        => 'be',
        // Locale::Bengali->value           => 'bn',
        // Locale::Bosnian->value           => 'bs',
        Locale::Bulgarian->value         => LanguageCode::BULGARIAN,
        // Locale::Catalan->value           => 'ca',
        // Locale::CentralKhmer->value      => 'km',
        Locale::Chinese->value           => LanguageCode::CHINESE,
        Locale::ChineseHongKong->value   => LanguageCode::CHINESE,
        // Locale::ChineseT->value          => 'zh-TW',
        // Locale::Croatian->value          => 'hr',
        Locale::Czech->value             => LanguageCode::CZECH,
        Locale::Danish->value            => LanguageCode::DANISH,
        Locale::Dutch->value             => LanguageCode::DUTCH,
        Locale::Estonian->value          => LanguageCode::ESTONIAN,
        Locale::English->value           => LanguageCode::ENGLISH,
        Locale::Finnish->value           => LanguageCode::FINNISH,
        Locale::French->value            => LanguageCode::FRENCH,
        // Locale::Galician->value          => 'gl',
        // Locale::Georgian->value          => 'ka',
        Locale::German->value            => LanguageCode::GERMAN,
        Locale::GermanSwitzerland->value => LanguageCode::GERMAN,
        Locale::Greek->value             => LanguageCode::GREEK,
        // Locale::Gujarati->value          => 'gu',
        // Locale::Hebrew->value            => 'he',
        // Locale::Hindi->value             => 'hi',
        Locale::Hungarian->value         => LanguageCode::HUNGARIAN,
        // Locale::Icelandic->value         => 'is',
        Locale::Indonesian->value        => LanguageCode::INDONESIAN,
        Locale::Italian->value           => LanguageCode::ITALIAN,
        Locale::Japanese->value          => LanguageCode::JAPANESE,
        // Locale::Kannada->value           => 'kn',
        // Locale::Kazakh->value            => 'kk',
        Locale::Korean->value            => LanguageCode::KOREAN,
        Locale::Latvian->value           => LanguageCode::LATVIAN,
        Locale::Lithuanian->value        => LanguageCode::LITHUANIAN,
        // Locale::Macedonian->value        => 'mk',
        // Locale::Malay->value             => 'ms',
        // Locale::Marathi->value           => 'mr',
        // Locale::Mongolian->value         => 'mn',
        // Locale::Nepali->value            => 'ne',
        Locale::NorwegianBokmal->value   => LanguageCode::NORWEGIAN,
        Locale::NorwegianNynorsk->value  => LanguageCode::NORWEGIAN,
        // Locale::Occitan->value => 'oc',
        // Locale::Pashto->value            => 'ps',
        // Locale::Persian->value           => 'fa',
        // Locale::Pilipino->value          => 'fil',
        Locale::Polish->value            => LanguageCode::POLISH,
        Locale::Portuguese->value        => LanguageCode::PORTUGUESE,
        Locale::PortugueseBrazil->value  => LanguageCode::PORTUGUESE_BRAZILIAN,
        Locale::Romanian->value          => LanguageCode::ROMANIAN,
        Locale::Russian->value           => LanguageCode::RUSSIAN,
        // Locale::Sardinian->value => 'sc',
        // Locale::SerbianCyrillic->value   => 'sr',
        // Locale::SerbianLatin->value       => 'sr-Latn',
        // Locale::SerbianMontenegrin->value => 'sr-Latn-ME',
        // Locale::Sinhala->value           => 'si',
        Locale::Slovak->value            => LanguageCode::SLOVAK,
        Locale::Slovenian->value         => LanguageCode::SLOVENIAN,
        Locale::Spanish->value           => LanguageCode::SPANISH,
        // Locale::Swahili->value           => 'sw',
        Locale::Swedish->value           => LanguageCode::SWEDISH,
        // Locale::Tagalog->value           => 'tl',
        // Locale::Tajik->value             => 'tg',
        // Locale::Thai->value              => 'th',
        Locale::Turkish->value           => LanguageCode::TURKISH,
        // Locale::Turkmen->value           => 'tk',
        // Locale::Uighur->value            => 'ug',
        Locale::Ukrainian->value         => LanguageCode::UKRAINIAN,
        // Locale::Urdu->value              => 'ur',
        // Locale::UzbekCyrillic->value     => 'uz',
        // Locale::UzbekLatin->value        => 'uz-Latn',
        // Locale::Vietnamese->value        => 'vi',
        // Locale::Welsh->value             => 'cy',
    ];

    public function __construct(
        protected DeeplTranslate $translator
    ) {}

    protected function request(array|string $text, Locale|string $to, Locale|string|null $from): Collection
    {
        $translated = $this->translator->translateText($text, $this->locale($from), $this->locale($to));

        return is_array($text) ? collect($translated)->pluck('text') : collect($translated->text);
    }
}
