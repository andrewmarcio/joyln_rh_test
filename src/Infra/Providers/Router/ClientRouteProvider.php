<?php

namespace Infra\Providers\Router;

use Support\Router\Router;

class ClientRouteProvider
{
    public function __construct()
    {
        Router::group(
            ["prefix" => 'clientes'],
            function () {
                Router::get('/', 'ClientController@index', ['as' => 'clients.index']);
                Router::get('/{id}', 'ClientController@show', ['as' => 'clients.show']);
                Router::post('/', 'ClientController@store', ['as' => 'clients.store']);
                Router::put('/{id}', 'ClientController@update', ['as' => 'clients.update']);
                Router::delete('/{id}', 'ClientController@delete', ['as' => 'clients.delete']);
            }
        );
    }
}
