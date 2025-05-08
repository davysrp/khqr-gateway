<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;
use KHQR\Helpers\EMV;

class MerchantCategoryCode extends TagLengthString
{
    public function __construct(string $tag, ?string $value)
    {
        if ($value === '' || $value == null) {
            throw new KHQRException(KHQRException::MERCHANT_CATEGORY_TAG_REQUIRED);
        }
        if (strlen($value) > EMV::INVALID_LENGTH_MERCHANT_CATEGORY_CODE) {
            throw new KHQRException(KHQRException::MERCHANT_CODE_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}
