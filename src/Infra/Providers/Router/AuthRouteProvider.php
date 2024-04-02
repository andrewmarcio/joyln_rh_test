<?php

namespace Infra\Providers\Router;

use Support\Router\Router;

class AuthRouteProvider
{
    public function __construct()
    {
        Router::group(
            ["prefix" => 'autenticacao'],
            function () {
                Router::post('/login', 'AuthController@login', ['as' => 'authentication.login']);
            }
        );
    }
}
