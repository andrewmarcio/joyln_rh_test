<?php

namespace Domain\Order\Resource;

use Support\Traits\MakeResourceMethod;

class OrderResource {
    use MakeResourceMethod;

    public static function resource(mixed $entity): array {
        return [
            "ID" => $entity->attributes['id'],
            "CLIENTE" => $entity->attributes['client_id'],
            "ITEMS" => json_decode($entity->attributes['items']),
            "CRIADO_EM" => dateFormat($entity->attributes['created_at']),
            "ATUALIZADO_EM" => dateFormat($entity->attributes['updated_at']),
        ];
    }
}