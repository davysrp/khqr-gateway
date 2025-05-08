<?php

declare(strict_types=1);

namespace KHQR\Helpers;

use KHQR\Models\AdditionalData;
use KHQR\Models\CountryCode;
use KHQR\Models\CRC;
use KHQR\Models\GlobalUniqueIdentifier;
use KHQR\Models\MerchantCategoryCode;
use KHQR\Models\MerchantCity;
use KHQR\Models\MerchantInformationLanguageTemplate;
use KHQR\Models\MerchantName;
use KHQR\Models\PayloadFormatIndicator;
use KHQR\Models\PointOfInitiationMethod;
use KHQR\Models\Timestamp;
use KHQR\Models\TransactionAmount;
use KHQR\Models\TransactionCurrency;
use KHQR\Models\UnionpayMerchantAccount;

final class KHQRData
{
    public const CURRENCY_USD = 840;

    public const CURRENCY_KHR = 116;

    public const MERCHANT_TYPE_MERCHANT = 'merchant';

    public const MERCHANT_TYPE_INDIVIDUAL = 'individual';

    public const KHQRTag = [
        [
            'tag' => '00',
            'type' => 'payloadFormatIndicator',
            'required' => true,
            'instance' => PayloadFormatIndicator::class,
        ],
        [
            'tag' => '01',
            'type' => 'pointofInitiationMethod',
            'required' => false,
            'instance' => PointOfInitiationMethod::class,
        ],
        [
            'tag' => '15',
            'type' => 'unionPayMerchant',
            'required' => false,
            'instance' => UnionpayMerchantAccount::class,
        ],
        [
            'sub' => true,
            'tag' => '29',
            'type' => 'globalUniqueIdentifier',
            'required' => true,
            'instance' => GlobalUniqueIdentifier::class,
        ],
        [
            'tag' => '52',
            'type' => 'merchantCategoryCode',
            'required' => true,
            'instance' => MerchantCategoryCode::class,
        ],
        [
            'tag' => '53',
            'type' => 'transactionCurrency',
            'required' => true,
            'instance' => TransactionCurrency::class,
        ],
        [
            'tag' => '54',
            'type' => 'transactionAmount',
            'required' => false,
            'instance' => TransactionAmount::class,
        ],
        [
            'tag' => '58',
            'type' => 'countryCode',
            'required' => true,
            'instance' => CountryCode::class,
        ],
        [
            'tag' => '59',
            'type' => 'merchantName',
            'required' => true,
            'instance' => MerchantName::class,
        ],
        [
            'tag' => '60',
            'type' => 'merchantCity',
            'required' => true,
            'instance' => MerchantCity::class,
        ],
        [
            'sub' => true,
            'tag' => '62',
            'type' => 'additionalData',
            'required' => false,
            'instance' => AdditionalData::class,
        ],
        [
            'sub' => true,
            'tag' => '64',
            'type' => 'merchantInformationLanguageTemplate',
            'required' => false,
            'instance' => MerchantInformationLanguageTemplate::class,
        ],
        [
            'tag' => '99',
            'type' => 'timestamp',
            'required' => false,
            'instance' => Timestamp::class,
        ],
        [
            'tag' => '63',
            'type' => 'crc',
            'required' => true,
            'instance' => CRC::class,
        ],
    ];

    public const KHQRSubtag = [
        'input' => [
            [
                'tag' => '29',
                'data' => [
                    'bakongAccountID' => null,
                    'accountInformation' => null,
                ],
            ],
            [
                'tag' => '30',
                'data' => [
                    'bakongAccountID' => null,
                    'merchantID' => null,
                    'acquiringBank' => null,
                ],
            ],
            [
                'tag' => '62',
                'data' => [
                    'billNumber' => null,
                    'mobileNumber' => null,
                    'storeLabel' => null,
                    'terminalLabel' => null,
                    'purposeOfTransaction' => null,
                ],
            ],
            [
                'tag' => '64',
                'data' => [
                    'languagePreference' => null,
                    'merchantNameAlternateLanguage' => null,
                    'merchantCityAlternateLanguage' => null,
                ],
            ],
        ],
        'compare' => [
            [
                'tag' => '29',
                'subTag' => EMV::BAKONG_ACCOUNT_IDENTIFIER,
                'name' => 'bakongAccountID',
            ],
            [
                'tag' => '29',
                'subTag' => EMV::MERCHANT_ACCOUNT_INFORMATION_MERCHANT_ID,
                'name' => 'accountInformation',
            ],
            [
                'tag' => '29',
                'subTag' => EMV::MERCHANT_ACCOUNT_INFORMATION_ACQUIRING_BANK,
                'name' => 'acquiringBank',
            ],
            [
                'tag' => '62',
                'subTag' => EMV::BILLNUMBER_TAG,
                'name' => 'billNumber',
            ],
            [
                'tag' => '62',
                'subTag' => EMV::ADDITIONAL_DATA_FIELD_MOBILE_NUMBER,
                'name' => 'mobileNumber',
            ],
            [
                'tag' => '62',
                'subTag' => EMV::STORELABEL_TAG,
                'name' => 'storeLabel',
            ],
            [
                'tag' => '62',
                'subTag' => EMV::PURPOSE_OF_TRANSACTION,
                'name' => 'purposeOfTransaction',
            ],
            [
                'tag' => '62',
                'subTag' => EMV::TERMINAL_TAG,
                'name' => 'terminalLabel',
            ],
            [
                'tag' => '64',
                'subTag' => EMV::LANGUAGE_PREFERENCE,
                'name' => 'languagePreference',
            ],
            [
                'tag' => '64',
                'subTag' => EMV::MERCHANT_NAME_ALTERNATE_LANGUAGE,
                'name' => 'merchantNameAlternateLanguage',
            ],
            [
                'tag' => '64',
                'subTag' => EMV::MERCHANT_CITY_ALTERNATE_LANGUAGE,
                'name' => 'merchantCityAlternateLanguage',
            ],
        ],
    ];
}
