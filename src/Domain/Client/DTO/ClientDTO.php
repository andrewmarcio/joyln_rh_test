<?php

namespace Domain\Client\DTO;

use Exception;
use Support\Response\HttpStatusCode;

class ClientDTO
{
    public function __construct(
        protected string|null $name,
        protected string|null $city
    ) {
        $this->name = $name;
        $this->city = $city;

        if (is_null($this->name) || empty($this->name)) {
            throw new Exception("Nome do cliente é obrigatório", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($this->name) > 50) {
            throw new Exception("Nome do cliente deve possuir no máximo 50 caracteres.", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (is_null($this->city) || empty($this->city)) {
            throw new Exception("Cidade do cliente é obrigatória", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($this->city) > 50) {
            throw new Exception("Nome do cliente deve possuir no máximo 50 caracteres.", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public static function fromArray(array $data): self
    {
        $fields = [
            "name" => $data['NOME'],
            "city" => $data['CIDADE_NOME'],
        ];
        return new static(...$fields);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
