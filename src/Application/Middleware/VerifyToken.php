<?php

namespace Application\Middleware;

use Exception;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Support\Response\HttpStatusCode;

class VerifyToken implements IMiddleware
{
    public function handle(Request $request): void
    {
        $authHeader = $request->getHeader("Authorization");
        
        if (is_null($authHeader) || !str_contains($authHeader, "Bearer")) {
            throw new Exception("Unauthorized", HttpStatusCode::HTTP_UNAUTHORIZED);
        }
        
        $token = explode(" ", $authHeader)[1] ?? null;
        $tokenArray = explode('.', $token);
        $payload = json_decode(base64_decode($tokenArray[1] ?? null));

        if (empty($payload)) {
            throw new Exception("Unauthorized", HttpStatusCode::HTTP_UNAUTHORIZED);
        }

        $expires = $payload->exp;
        $today = date('d-m-Y H:i:s');
        if (strtotime($today) > strtotime(date('d-m-Y H:i:s', $expires))) {
            throw new Exception("Expired token", HttpStatusCode::HTTP_UNAUTHORIZED);
        }
    }
}
