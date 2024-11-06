<?php

declare(strict_types=1);

namespace App\Crade\GradeCarCost\DTO;

use App\Infrastructure\VO\Comment;
use App\Infrastructure\VO\Email;
use App\Infrastructure\VO\Price;

final readonly class CarCostRequest
{
    public function __construct(
        public Price $price,
        public Comment $comment,
        public Email $email,
    ) {
    }
}