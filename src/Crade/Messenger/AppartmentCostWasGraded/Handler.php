<?php

declare(strict_types=1);

namespace App\Crade\Messenger\AppartmentCostWasGraded;

use App\Crade\GradeAppartmentCost\Entity\AppartmentCost;
use App\Crade\GradeAppartmentCost\Repository\Repository;
use App\Crade\Messenger\AppartmentCostWasGraded\DTO\Request;
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

    private function crateRequest(AppartmentCost $carCost): TelegramRequest
    {
        // тут как то соберем объект если надо в отдельный срвис закинем
        return new TelegramRequest();
    }
}