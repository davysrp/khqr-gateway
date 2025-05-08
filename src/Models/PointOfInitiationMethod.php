<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Exceptions\KHQRException;

class PointOfInitiationMethod extends TagLengthString
{
    public function __construct(string $tag, string $value)
    {
        if (strlen($value) > 2) {
            throw new KHQRException(KHQRException::POINT_INITIATION_LENGTH_INVALID);
        }
        parent::__construct($tag, $value);
    }
}
