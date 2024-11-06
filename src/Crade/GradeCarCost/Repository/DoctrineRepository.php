<?php

declare(strict_types=1);

namespace App\Crade\GradeCarCost\Repository;

use App\Crade\GradeCarCost\Entity\CarCost;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final readonly class DoctrineRepository implements Repository
{
    /**
     * @var EntityRepository<CarCost>
     */
    private EntityRepository $carCostRepository;

    public function __construct(private EntityManagerInterface $em)
    {
        $this->carCostRepository = $em->getRepository(CarCost::class);
    }


    public function save(CarCost $carCost): CarCost
    {
        $em = $this->carCostRepository->getEntityManager();
        $em->persist($carCost);
        $em->flush();
    }

    public function find(int $id): CarCost
    {
        return $this->carCostRepository->find($id);
    }
}