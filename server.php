<?php
error_reporting(E_ALL ^ E_DEPRECATED);

require __DIR__ . '/vendor/autoload.php';

function createApp()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    (new Infra\Providers\Router\RouteServiceProvider)->boot();
}

try {
    createApp();
} catch (\Throwable $th) {
    die((new Support\Handler\ErrorHandler(
        message: $th->getMessage(),
        code: $th->getCode(),
        previous: $th
    ))->handle());
}
