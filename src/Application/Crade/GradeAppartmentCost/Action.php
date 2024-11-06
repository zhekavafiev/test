<?php

declare(strict_types=1);

namespace App\Application\Crade\GradeAppartmentCost;

use App\Crade\GradeAppartmentCost\DTO\AppartmentCostRequest;
use App\Crade\GradeAppartmentCost\Handler;
use App\Infrastructure\Framework\AbstractController;
use App\Infrastructure\Serializer\SerializerInterface;
use App\Infrastructure\VO\Comment;
use App\Infrastructure\VO\Email;
use App\Infrastructure\VO\Price;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;

final class Action extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route(path: '/appartment_cost', name: 'appartment_car_cost', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload]
        Request $request,
        Handler $handler,
        SerializerInterface $serializer
    ): JsonResponse {
        return $this->success($serializer->normalize($handler(
            new AppartmentCostRequest(
                Price::fromString($request->price),
                Comment::fromString($request->comment),
                Email::fromString($request->email)
            )
        )));
    }
}