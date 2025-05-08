<?php

declare(strict_types=1);

namespace KHQR\Api;

use Exception;
use KHQR\Exceptions\KHQRException;

class DeepLink
{
    public static function isValidLink(string $link): bool
    {
        try {
            $url = parse_url($link);
            if (! isset($url['path']) || $url['path'] !== '/v1/generate_deeplink_by_qr') {
                return false;
            }

            return true;
        } catch (Exception $error) {
            return false;
        }
    }

    /**
     * @param  string  $url  Bakong API endpoint for generating deep link
     * @param  array<string, mixed>  $data  payload to send
     * @return mixed response body
     */
    public static function callDeepLinkAPI(string $url, array $data)
    {
        try {
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 45);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);

            curl_close($ch);

            if ($curlError !== '' && $curlError !== '0') {
                throw new KHQRException(KHQRException::CONNECTION_TIMEOUT);
            }

            $respBody = json_decode((string) $response, true);

            if ($httpCode !== 200 || $respBody === null) {
                throw new KHQRException(KHQRException::CONNECTION_TIMEOUT);
            }

            if (! is_array($respBody)) {
                return $respBody;
            }

            $error = $respBody['errorCode'] ?? null;
            if ($error == 5) {
                throw new KHQRException(KHQRException::INVALID_DEEP_LINK_SOURCE_INFO);
            }

            if ($error == 4) {
                throw new KHQRException(KHQRException::INTERNAL_SERVER_ERROR);
            }

            return $respBody;
        } catch (Exception $error) {
            throw new KHQRException(KHQRException::CONNECTION_TIMEOUT);
        }
    }
}
