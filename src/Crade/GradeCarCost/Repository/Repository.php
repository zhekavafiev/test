<?php

declare(strict_types=1);

namespace App\Crade\GradeCarCost\Repository;

use App\Crade\GradeCarCost\Entity\CarCost;

interface Repository
{
    public function save(CarCost $carCost): CarCost;
    public function find(int $id): CarCost;
}