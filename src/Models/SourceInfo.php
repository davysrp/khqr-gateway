<?php

declare(strict_types=1);

namespace KHQR\Models;

class SourceInfo
{
    public ?string $appIconUrl;

    public ?string $appName;

    public ?string $appDeepLinkCallback;

    public function __construct(?string $appIconUrl, ?string $appName, ?string $appDeepLinkCallback)
    {
        $this->appIconUrl = $appIconUrl;
        $this->appName = $appName;
        $this->appDeepLinkCallback = $appDeepLinkCallback;
    }
}
