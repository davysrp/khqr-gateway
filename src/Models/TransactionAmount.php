<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;
use KHQR\Helpers\EMV;

class TransactionAmount extends TagLengthString
{
    public function __construct(string $tag, string $value)
    {
        if (
            strlen($value) > EMV::INVALID_LENGTH_AMOUNT ||
            strpos($value, '-') !== false ||
            $value === '' ||
            $value == null
        ) {
            throw new KHQRException(KHQRException::TRANSACTION_AMOUNT_INVALID);
        }

        parent::__construct($tag, $value);
    }
}
