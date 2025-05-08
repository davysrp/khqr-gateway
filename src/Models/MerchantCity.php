<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;
use KHQR\Helpers\EMV;

class MerchantCity extends TagLengthString
{
    public function __construct(string $tag, ?string $value)
    {
        if ($value === '' || $value == null) {
            throw new KHQRException(KHQRException::MERCHANT_CITY_TAG_REQUIRED);
        }
        if (mb_strlen($value, 'UTF-8') > EMV::INVALID_LENGTH_MERCHANT_CITY) {
            throw new KHQRException(KHQRException::MERCHANT_CITY_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}
