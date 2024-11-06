<?php

declare(strict_types=1);

namespace App\Crade\GradeAppartmentCost\Repository;

use App\Crade\GradeAppartmentCost\Entity\AppartmentCost;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final readonly class DoctrineRepository implements Repository
{
    /**
     * @var EntityRepository<AppartmentCost>
     */
    private EntityRepository $appaartmentCost;

    public function __construct(private EntityManagerInterface $em)
    {
        $this->appaartmentCost = $em->getRepository(AppartmentCost::class);
    }


    public function save(AppartmentCost $appartmentCost): AppartmentCost
    {
        $em = $this->appaartmentCost->getEntityManager();
        $em->persist($appartmentCost);
        $em->flush();
        return $appartmentCost;
    }

    public function find(int $id): AppartmentCost
    {
        return $this->appaartmentCost->find($id);
    }
}