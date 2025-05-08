<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;
use KHQR\Helpers\EMV;

class MerchantInformationLanguageTemplate extends TagLengthString
{
    /** @var array<string, ?string> */
    public array $data;

    public function __construct($tag, $value)
    {
        if ($value === null) {
            $value = [
                'languagePreference' => null,
                'merchantNameAlternateLanguage' => null,
                'merchantCityAlternateLanguage' => null,
            ];
        }

        assert(is_array($value));

        if (! empty($value['languagePreference']) && empty($value['merchantNameAlternateLanguage'])) {
            throw new KHQRException(KHQRException::MERCHANT_NAME_ALTERNATE_LANGUAGE_REQUIRED);
        }

        $merchantInformationLanguageTemplateString = '';

        $preference = new LanguagePreference(EMV::LANGUAGE_PREFERENCE, $value['languagePreference']);
        $merchantInformationLanguageTemplateString .= $preference;

        if (! empty($value['merchantNameAlternateLanguage'])) {
            $alterName = new MerchantNameAlternateLanguage(EMV::MERCHANT_NAME_ALTERNATE_LANGUAGE, $value['merchantNameAlternateLanguage']);
            $merchantInformationLanguageTemplateString .= $alterName;
        }

        if (! empty($value['merchantCityAlternateLanguage'])) {
            $alterCity = new MerchantCityAlternateLanguage(EMV::MERCHANT_CITY_ALTERNATE_LANGUAGE, $value['merchantCityAlternateLanguage']);
            $merchantInformationLanguageTemplateString .= $alterCity;
        }

        parent::__construct($tag, $merchantInformationLanguageTemplateString);
        $this->data = $value;
    }
}

class LanguagePreference extends TagLengthString
{
    public function __construct(string $tag, ?string $value)
    {
        if (is_null($value) || strlen($value) > EMV::INVALID_LENGTH_LANGUAGE_PREFERENCE || $value === '') {
            throw new KHQRException(KHQRException::LANGUAGE_PREFERENCE_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}

class MerchantNameAlternateLanguage extends TagLengthString
{
    public function __construct(string $tag, string $value)
    {
        if (mb_strlen($value, 'UTF-8') > EMV::INVALID_LENGTH_MERCHANT_NAME_ALTERNATE_LANGUAGE || $value === '') {
            throw new KHQRException(KHQRException::MERCHANT_NAME_ALTERNATE_LANGUAGE_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}

class MerchantCityAlternateLanguage extends TagLengthString
{
    public function __construct(string $tag, string $value)
    {
        if (mb_strlen($value, 'UTF-8') > EMV::INVALID_LENGTH_MERCHANT_CITY_ALTERNATE_LANGUAGE || $value === '') {
            throw new KHQRException(KHQRException::MERCHANT_CITY_ALTERNATE_LANGUAGE_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}
