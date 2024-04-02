<?php

namespace Infra\Providers\Router;

use Support\Router\Router;

class RouteServiceProvider
{
    public function register()
    {
        return (new Router)
            ->group(
                ['prefix' => 'test-dev-php'],
                function () {
                    Router::group(['prefix' => 'api'], function () {
                        (new ClientRouteProvider);
                    });
                }
            );
    }

    public function boot()
    {
        $this->register();
        return Router::start();
    }
}
