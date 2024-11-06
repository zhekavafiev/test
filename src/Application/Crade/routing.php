<?php

declare(strict_types=1);

namespace App\Application\Api;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routing): void {
    $routing
        ->import(__DIR__, 'attribute')
            ->prefix('/api/v1')
            ->format('json');
};
