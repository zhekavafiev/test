<?php

declare(strict_types=1);

namespace App\Infrastructure\Notification\TelegrammClient;

use App\Infrastructure\Notification\Client;
use App\Infrastructure\Notification\TelegrammClient\DTO\Request;
use App\Infrastructure\Notification\TelegrammClient\DTO\Response;

final readonly class TelegrammClient implements Client
{
    public function __construct()
    {
    }

    public function send(Request $request): Response
    {
        // TODO: Implement send() method.
    }
}