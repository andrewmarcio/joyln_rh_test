<?php

namespace Domain\Order\DTO;

use Exception;
use Support\Response\HttpStatusCode;

class OrderDTO
{
    public function __construct(
        protected int|null $client_id,
        protected array|null $items
    ) {
        if (is_null($this->client_id) || empty($this->client_id)) {
            throw new Exception("Identificação do cliente é obrigatório", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (is_null($this->items) || empty($this->items) || !count($this->items)) {
            throw new Exception("Itens de pedido são obrigatórios", HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public static function fromArray(array $data): self
    {
        $fields = [
            "client_id" => $data['client_id'],
            "items" => $data['items'],
        ];
        return new static(...$fields);
    }

    public function toArray(): array
    {
        return [
            'client_id' => $this->client_id,
            'items' => json_encode($this->items)
        ];
    }
}
