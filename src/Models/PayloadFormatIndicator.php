<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;

class PayloadFormatIndicator extends TagLengthString
{
    public function __construct(string $tag, ?string $value)
    {
        if ($value === '' || $value === null) {
            throw new KHQRException(KHQRException::PAYLOAD_FORMAT_INDICATOR_TAG_REQUIRED);
        }
        if (strlen($value) > 2) {
            throw new KHQRException(KHQRException::PAYLOAD_FORMAT_INDICATOR_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}
