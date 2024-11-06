<?php

declare(strict_types=1);

namespace App\Crade\GradeCarCost;

use App\Crade\GradeAppartmentCost\DTO\AppartmentCostRequest;
use App\Crade\GradeCarCost\Entity\CarCost;
use App\Crade\GradeCarCost\Repository\Repository;
use App\Crade\Messenger\CarCostWasGraded\DTO\Request;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class Handler
{
    public function __construct(
        private Repository $repository,
        private MessageBusInterface $messageBus,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function __invoke(AppartmentCostRequest $request): CarCost
    {
        $carCost = new CarCost();
        $carCost->setEmail($request->email->email);
        $carCost->setPrice($request->price->price);
        $carCost->setComment($request->comment->comment);
        $this->repository->save($carCost);
        $this->messageBus->dispatch(new Request($carCost->getId()));
        return $carCost;
    }
}