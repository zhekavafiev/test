<?php

declare(strict_types=1);

namespace App\Crade\GradeAppartmentCost\Repository;

use App\Crade\GradeAppartmentCost\Entity\AppartmentCost;

final readonly class RawRepository implements Repository
{
    public function __construct()
    {
    }

    public function save(AppartmentCost $carCost): AppartmentCost
    {
        // TODO: Implement save() method.
    }

    public function find(int $id): AppartmentCost
    {
        // TODO: Implement find() method.
    }
}