<?php

namespace Domain\Product\DTO;

use Exception;
use Support\Response\HttpStatusCode;

class ProductDTO
{
    public function __construct(
        protected string|null $name,
        protected float|null $unit_value
    ) {
        $this->name = $name;
        $this->unit_value = $unit_value;

        if (is_null($this->name) || empty($this->name)) {
            throw new Exception("Nome do produto é obrigatório", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (strlen($this->name) > 50) {
            throw new Exception("Nome do produto deve possuir no máximo 50 caracteres.", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (is_null($this->unit_value) || empty($this->unit_value)) {
            throw new Exception("Valor unitário do produto é obrigatório", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public static function fromArray(array $data): self
    {
        $fields = [
            "name" => $data['NOME'],
            "unit_value" => number_format((float)$data['VLRUNIT'], 2),
        ];
        return new static(...$fields);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
