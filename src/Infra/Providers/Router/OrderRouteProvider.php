<?php

namespace Infra\Providers\Router;

use Application\Middleware\VerifyToken;
use Support\Router\Router;

class OrderRouteProvider
{
    public function __construct()
    {
        Router::group(
            [
                "prefix" => 'pedidos',
                "middleware" => VerifyToken::class
            ],
            function () {
                Router::get("/", "OrderController@index", ["as" => "orders.index"]);
                Router::get("/{id}", "OrderController@show", ["as" => "orders.show"]);
                Router::post("/", "OrderController@store", ["as" => "orders.store"]);
                Router::put("/{id}", "OrderController@update", ["as" => "orders.update"]);
                Router::delete("/{id}", "OrderController@delete", ["as" => "orders.delete"]);
            }
        );
    }
}
