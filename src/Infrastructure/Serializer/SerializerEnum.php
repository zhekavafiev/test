<?php

declare(strict_types=1);

namespace App\Infrastructure\Serializer;

enum SerializerEnum: string
{
    case JSON_SERIALIZER = 'json';

    /**
     * @throws InvalidSerializerException
     */
    public static function fromName(string $name): ?string
    {
        foreach (self::cases() as $case) {
            if ($name === $case->name) {
                return $case->value;
            }
        }

        throw new InvalidSerializerException("Unknown serializer: {$name}");
    }
}
