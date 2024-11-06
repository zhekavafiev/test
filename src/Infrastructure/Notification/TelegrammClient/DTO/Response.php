<?php

declare(strict_types=1);

namespace App\Infrastructure\Notification\TelegrammClient\DTO;

use App\Infrastructure\Notification\ResponseInterface;

final readonly class Response implements ResponseInterface
{
    public function __construct()
    {
    }
}