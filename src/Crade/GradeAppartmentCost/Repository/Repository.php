<?php

declare(strict_types=1);

namespace App\Crade\GradeAppartmentCost\Repository;

use App\Crade\GradeAppartmentCost\Entity\AppartmentCost;

interface Repository
{
    public function save(AppartmentCost $carCost): AppartmentCost;
    public function find(int $id): AppartmentCost;
}