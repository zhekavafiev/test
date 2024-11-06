<?php

declare(strict_types=1);

namespace App\Infrastructure\VO;

final class Comment
{
    private function __construct(public string $comment)
    {
    }

    public static function fromString(string $comment): self
    {
        // тут кака ято проверка что комментарий не содержит наприме иньекций
        $commentValid = true;
        if (! $commentValid) {
            throw new \InvalidArgumentException('Invalid comment');
        }
        return new self($comment);
    }
}