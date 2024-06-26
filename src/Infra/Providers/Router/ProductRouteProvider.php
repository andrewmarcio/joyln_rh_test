<?php

namespace Infra\Providers\Router;

use Application\Middleware\VerifyToken;
use Support\Router\Router;

class ProductRouteProvider
{
    public function __construct()
    {
        Router::group(
            [
                "prefix" => 'produtos',
                "middleware" => VerifyToken::class
            ],
            function () {
                Router::get("/", "ProductController@index", ["as" => "products.index"]);
                Router::get("/{id}", "ProductController@show", ["as" => "products.show"]);
                Router::post("/", "ProductController@store", ["as" => "products.store"]);
                Router::put("/{id}", "ProductController@update", ["as" => "products.update"]);
                Router::delete("/{id}", "ProductController@delete", ["as" => "products.delete"]);
            }
        );
    }
}
