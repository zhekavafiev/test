<?php

declare(strict_types=1);

namespace App\Crade\GradeCarCost\Repository;

use App\Crade\GradeCarCost\Entity\CarCost;

final readonly class RawRepository implements Repository
{
    public function __construct()
    {
    }

    public function save(CarCost $carCost): CarCost
    {
        // TODO: Implement save() method.
    }

    public function find(int $id): CarCost
    {
        // TODO: Implement find() method.
    }
}