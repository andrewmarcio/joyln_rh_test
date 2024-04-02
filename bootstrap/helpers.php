<?php

use Pecee\Http\Request;
use Pecee\Http\Response;
use Support\Router\Router;

function env(string $key, mixed $default = null): string
{
    return $_ENV[$key] ?? $default;
}

/*
 * returnJsonHttpResponse
 * @param $success: Boolean
 * @param $data: Object or Array
 */
function responseJson(mixed $data, int $httpCode): string|false
{
    ob_start();
    ob_clean();

    header_remove();
    header("Content-type: application/json; charset=utf-8");

    http_response_code($httpCode);
    return json_encode($data);
}

function dateFormat(string|null $date): string|null
{
    if (!$date)
        return null;

    return date_format(new DateTime($date), 'd/m/Y H:i:s');
}

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|mixed|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */

function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}
