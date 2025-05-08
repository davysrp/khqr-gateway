<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;
use KHQR\Helpers\KHQRData;

class TransactionCurrency extends TagLengthString
{
    public function __construct(string $tag, $value)
    {
        if ($value == null) {
            throw new KHQRException(KHQRException::CURRENCY_TYPE_REQUIRED);
        }

        $value = (string) $value;

        if (strlen($value) > 3) {
            throw new KHQRException(KHQRException::TRANSACTION_CURRENCY_LENGTH_INVALID);
        }
        if (! in_array((int) $value, [KHQRData::CURRENCY_KHR, KHQRData::CURRENCY_USD])) {
            throw new KHQRException(KHQRException::UNSUPPORTED_CURRENCY);
        }
        parent::__construct($tag, $value);
    }
}
