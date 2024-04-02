<?php

namespace Presentation\Http\Controllers;

use Application\Services\AuthService;
use Support\Response\HttpStatusCode;

class AuthController
{
    public function __construct(
        private AuthService $service = new AuthService
    ) {
    }

    public function login()
    {
        $credentials = [
            "username" => input()->post('username')->value,
            "password" => md5(input()->post('password')->value)
        ];

        $token = $this->service->login($credentials);
        
        return responseJson([
            "token" => $token
        ], HttpStatusCode::HTTP_OK);
    }
}
