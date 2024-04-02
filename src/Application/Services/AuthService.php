<?php

namespace Application\Services;

use Infra\Adapter\Http\Curl;

class AuthService {
    public function login(array $credentials) {
        $authentication = base64_encode(implode(":", $credentials));
        $headers = array(
            "Authorization: Basic $authentication",
            "Content-Type: application/json"
        );
        return Curl::post(env("BASE_AUTH_URL"), [], $headers)->getData();
    }
}