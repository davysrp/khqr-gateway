<?php

declare(strict_types=1);

namespace KHQR\Models;

class KHQRDeepLinkData
{
    public string $shortLink;

    public function __construct(string $shortLink)
    {
        $this->shortLink = $shortLink;
    }

    /**
     * @return array<string, string> short link array
     */
    public function getData(): array
    {
        return [
            'shortLink' => $this->shortLink,
        ];
    }
}
