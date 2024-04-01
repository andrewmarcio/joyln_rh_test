<?php

namespace Support\Router;

use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    private const NAMESPACE = 'Presentation\Http\Controllers';

    public function __construct()
    {
        self::setDefaultNamespace(Router::NAMESPACE);
    }
}
