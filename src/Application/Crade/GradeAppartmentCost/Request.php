<?php

declare(strict_types=1);

namespace App\Application\Crade\GradeAppartmentCost;

final readonly class Request
{
    public function __construct(
        public int $price,
        public ?string $comment,
        public string $email,
    ) {}
}