<?php

declare(strict_types=1);

namespace App\Infrastructure\VO;

final readonly class Email
{
    private function __construct(public string $email)
    {
    }

    public static function fromString(string $email): self
    {
        // тут кака ято проверка email ok
        $emailValid = true;
        if (! $emailValid) {
            throw new \InvalidArgumentException('Invalid email');
        }
        return new self($email);
    }
}