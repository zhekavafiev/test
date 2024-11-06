<?php

declare(strict_types=1);

namespace App\Crade\GradeAppartmentCost\DTO;

use App\Infrastructure\VO\Comment;
use App\Infrastructure\VO\Email;
use App\Infrastructure\VO\Price;

final readonly class AppartmentCostRequest
{
    public function __construct(
        public Price $price,
        public Comment $comment,
        public Email $email,
    ) {
    }
}