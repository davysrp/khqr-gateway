<?php

declare(strict_types=1);

namespace KHQR\Api;

use KHQR\Config\Constants;
use KHQR\Helpers\Utils;

class Token
{
    /**
     * @return array<string, mixed>
     */
    public static function renewToken(string $email, bool $isTest = false): array
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        $url = $isTest ? Constants::SIT_RENEW_TOKEN_URL : Constants::RENEW_TOKEN_URL;

        return Utils::post_data_to_url($url, ['email' => $email]);
    }

    public static function isExpiredToken(string $token): bool
    {
        if (Utils::isBlank($token)) {
            return true;
        }

        try {
            $exp = Utils::getExpirationDateFromJwtPayload($token);
            if ($exp == null) {
                return true;
            }

            return time() > $exp;
        } catch (\Exception $e) {
            var_dump('An exception occurred while validating expiration date from token: '.$token, $e);

            return true;
        }
    }
}
