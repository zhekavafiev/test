<?php

declare(strict_types=1);

namespace App\Crade\Messenger\CarCostWasGraded\DTO;

final readonly class Request
{
    public function __construct(
        public int $id,
    ) {}
}
