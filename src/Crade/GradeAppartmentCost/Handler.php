<?php

declare(strict_types=1);

namespace App\Crade\GradeAppartmentCost;

use App\Crade\GradeAppartmentCost\DTO\AppartmentCostRequest;
use App\Crade\GradeAppartmentCost\Entity\AppartmentCost;
use App\Crade\GradeAppartmentCost\Repository\Repository;
use App\Crade\Messenger\AppartmentCostWasGraded\DTO\Request;
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
    public function __invoke(AppartmentCostRequest $request): AppartmentCost
    {
        $appCost = new AppartmentCost();
        $appCost->setEmail($request->email->email);
        $appCost->setPrice($request->price->price);
        $appCost->setComment($request->comment->comment);
        $this->repository->save($appCost);
        $this->messageBus->dispatch(new Request($appCost->getId()));
        return $appCost;
    }
}