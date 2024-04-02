<?php

namespace Infra\Adapter\Http;

interface HttpAdapterInterface {
    public static function post(string $url, array $data, ?array $headers): self;
    public function getData(): mixed;
}