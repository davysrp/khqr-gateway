<?php

declare(strict_types=1);

namespace KHQR\Models;

use KHQR\Helpers\EMV;

class Timestamp extends TagLengthString
{
    private EMV $emv;

    public function __construct(string $tag, ?EMV $emv = null)
    {
        $this->emv = $emv;
        parent::__construct($tag, '');
    }

    /**
     * Generate the QR code timestamp payload.
     *
     * @param bool $static    
     * @param int  $expiration 
     * @return string        
     * @throws \InvalidArgumentException
     */
    public function value(bool $static, int $expiration = 1): string
    {
        // Current timestamp in milliseconds
        $currentMs = (string) floor(microtime(true) * 1000);
        $timestampLength = str_pad((string) strlen($currentMs), 2, '0', STR_PAD_LEFT);

        $data = $this->emv::LANGUAGE_PREFERENCE . $timestampLength . $currentMs;

        // Add expiration part for dynamic QR codes
        if (!$static) {
            if ($expiration < 1) {
                throw new \InvalidArgumentException(
                    "Expiration time cannot be less than 1 day. Your input: {$expiration} days."
                );
            }

            // Expiration timestamp as millisecond
            $expMs = (string) ((int) $currentMs + ($expiration * 86400 * 1000));
            $expLength = str_pad((string) strlen($expMs), 2, '0', STR_PAD_LEFT);

            $data .= $this->emv::LANGUAGE_PREFERENCE_EXP . $expLength . $expMs;
        }

        $totalLength = str_pad((string) strlen($data), 2, '0', STR_PAD_LEFT);

        return $this->emv::TIMESTAMP_TAG . $totalLength . $data;
    }
}