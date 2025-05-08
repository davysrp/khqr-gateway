<?php

declare(strict_types=1);

namespace KHQR\Models;

class KHQRResponse
{
    /**
     * @var array{
     *     code: int,
     *     errorCode: string|null,
     *     message: string|null
     * }
     */
    public array $status;

    public $data;

    /**
     * @param  array{code: string, message: string}|null  $errorObject
     */
    public function __construct($data, $errorObject)
    {
        $this->data = $data;

        $isError = $errorObject === null;
        $this->status = [
            'code' => $isError ? 0 : 1,
            'errorCode' => $isError ? null : $errorObject['code'],
            'message' => $isError ? null : $errorObject['message'],
        ];
    }

    public function __toString(): string
    {
        $json = json_encode([
            'status' => $this->status,
            'data' => $this->data,
        ]);

        if ($json === false) {
            return '{"status":{"code":1,"errorCode":"JSON_ERROR","message":"Failed to encode response"},"data":null}';
        }

        return $json;
    }
}
