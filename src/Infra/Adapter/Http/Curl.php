<?php

namespace Infra\Adapter\Http;

use CurlHandle;
use Exception;
use Support\Response\HttpStatusCode;

class Curl implements HttpAdapterInterface
{

    private CurlHandle|false $connection;
    private mixed $data;

    public function __construct(
        string $url,
        array $options
    ) {
        $this->connection = curl_init($url);
        curl_setopt_array($this->connection, $options);
        $this->data = curl_exec($this->connection);
        $errNo = curl_errno($this->connection);
        $error = curl_error($this->connection);
        curl_close($this->connection);
        if ($error || $errNo) {
            throw new Exception($error, HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public static function post(string $url, array $data, ?array $headers = []): self
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => false,
            // CURLOPT_ENCODING       => "utf-8",      
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_CONNECTTIMEOUT => 20,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_VERBOSE        => 1,
            CURLOPT_HTTPHEADER     => $headers

        );

        return new static(
            $url,
            $options,
        );
    }

    public function getData(): mixed
    {
        return json_decode($this->data);
    }
}
