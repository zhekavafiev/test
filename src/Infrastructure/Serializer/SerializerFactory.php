<?php

declare(strict_types=1);

namespace App\Infrastructure\Serializer;

final class SerializerFactory
{
    /**
     * @throws InvalidSerializerException
     */
    public static function create(SerializerEnum $serializer): SerializerInterface
    {
        return match ($serializer) {
            SerializerEnum::JSON_SERIALIZER => new JsonSerializer(),
            default => throw new InvalidSerializerException('Unknown serializer'),
        };
    }
}
