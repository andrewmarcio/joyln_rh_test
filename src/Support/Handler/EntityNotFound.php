<?php

namespace Support\Handler;

use Exception;
use Support\Response\HttpStatusCode;

class EntityNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct(
            "Could not find entity",
            HttpStatusCode::HTTP_NOT_FOUND,
        );
    }
}
