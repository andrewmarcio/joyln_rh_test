<?php

namespace Infra\Providers\Router;

use Support\Router\Router;

class OrderRouteProvider
{
    public function __construct()
    {
        Router::group(
            ["prefix" => 'pedidos'],
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
