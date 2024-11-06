<?php

declare(strict_types=1);

namespace App\Crade\Messenger\CarCostWasGraded;

use App\Crade\GradeCarCost\Entity\CarCost;
use App\Crade\GradeCarCost\Repository\Repository;
use App\Crade\Messenger\CarCostWasGraded\DTO\Request;
use App\Infrastructure\Notification\Client;
use App\Infrastructure\Notification\TelegrammClient\DTO\Request as TelegramRequest;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class Handler
{
    public function __construct(
        private Client $client,
        private Repository $repository,
    ) {}

    public function __invoke(Request $request): void
    {
        $this->client->send($this->crateRequest(
            $this->repository->find($request->id))
        );
    }

    private function crateRequest(CarCost $carCost): TelegramRequest
    {
        // тут как то соберем объект если надо в отдельный срвис закинем
        return new TelegramRequest();
    }
}