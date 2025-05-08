<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;
use KHQR\Helpers\EMV;

class CountryCode extends TagLengthString
{
    public function __construct(string $tag, ?string $value)
    {
        if ($value === '' || $value == null) {
            throw new KHQRException(KHQRException::COUNTRY_CODE_TAG_REQUIRED);
        }
        if (strlen($value) > EMV::INVALID_LENGTH_COUNTRY_CODE) {
            throw new KHQRException(KHQRException::COUNTRY_CODE_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}
