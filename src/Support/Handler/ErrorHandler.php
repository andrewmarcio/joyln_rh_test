<?php

namespace Support\Handler;

use Exception;

class ErrorHandler extends Exception
{
    public function handle()
    {
        return json_encode([
            "message" => $this->getMessage(),
            "code" => $this->getCode()
        ]);
    }
}
