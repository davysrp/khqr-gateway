<?php

declare(strict_types=1);

namespace KHQR\Models;

class CRCValidation
{
    public bool $isValid;

    public function __construct(bool $valid)
    {
        $this->isValid = $valid;
    }
}
