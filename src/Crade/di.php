<?php

declare(strict_types=1);

namespace App\Application\Api;

use App\Crade\GradeAppartmentCost\Handler;
use App\Crade\GradeAppartmentCost\Repository\DoctrineRepository;
use App\Crade\GradeAppartmentCost\Repository\Repository;
use App\Crade\GradeCarCost\Handler as CarCostHandler;
use App\Crade\GradeCarCost\Repository\Repository as CarCostRepository;
use App\Infrastructure\Notification\Client;
use App\Infrastructure\Notification\TelegrammClient\TelegrammClient;
use App\Infrastructure\Serializer\JsonSerializer;
use App\Infrastructure\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $di): void {
    $di->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
        ->set(Repository::class)
        ->set(DoctrineRepository::class)
            ->alias(Repository::class, DoctrineRepository::class)
        ->set(Handler::class)

        ->set(\App\Crade\GradeCarCost\Repository\Repository::class)
        ->set(\App\Crade\GradeCarCost\Repository\DoctrineRepository::class)
            ->alias(\App\Crade\GradeCarCost\Repository\Repository::class, \App\Crade\GradeCarCost\Repository\DoctrineRepository::class)
        ->set(CarCostHandler::class)
        ->set(SerializerInterface::class)
        ->set(JsonSerializer::class)
            ->alias(SerializerInterface::class, JsonSerializer::class)

        ->set(Client::class)
        ->set(TelegrammClient::class)
            ->alias(Client::class, TelegrammClient::class);

};
