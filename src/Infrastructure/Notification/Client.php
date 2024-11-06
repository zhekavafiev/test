<?php

declare(strict_types=1);

namespace App\Infrastructure\Notification;

use App\Infrastructure\Notification\TelegrammClient\DTO\Request;
use App\Infrastructure\Notification\TelegrammClient\DTO\Response;

interface Client
{
    public function send(Request $request): Response;
}