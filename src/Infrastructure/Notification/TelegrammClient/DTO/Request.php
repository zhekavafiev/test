<?php

declare(strict_types=1);

namespace App\Infrastructure\Notification\TelegrammClient\DTO;

use App\Infrastructure\Notification\RequestInterface;

final readonly class Request implements RequestInterface
{
    public function __construct()
    {
    }
}