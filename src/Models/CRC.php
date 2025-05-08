<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;

class CRC extends TagLengthString
{
    public function __construct(string $tag, string $value)
    {
        if ($value === '' || $value == null) {
            throw new KHQRException(KHQRException::CRC_TAG_REQUIRED);
        }
        if (strlen($value) > 4) {
            throw new KHQRException(KHQRException::CRC_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}
