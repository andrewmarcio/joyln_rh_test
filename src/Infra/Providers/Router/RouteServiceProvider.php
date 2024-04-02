<?php

namespace Infra\Providers\Router;

use Support\Router\Router;

class RouteServiceProvider
{
    public function register()
    {
        return (new Router)
            ->group(
                ['prefix' => 'test-dev-php/api'],
                function () {
                    new ClientRouteProvider;
                    new ProductRouteProvider;
                    new OrderRouteProvider;
                }
            );
    }

    public function boot()
    {
        $this->register();
        return Router::start();
    }
}
