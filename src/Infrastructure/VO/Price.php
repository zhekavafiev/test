<?php

declare(strict_types=1);

namespace App\Infrastructure\VO;

final readonly class Price
{
    private function __construct(public int $price)
    {
    }

    public static function fromString(int $price): self
    {
        if ($price < 0) {
            throw new \InvalidArgumentException('Invalid price');
        }
        return new self($price);
    }
}