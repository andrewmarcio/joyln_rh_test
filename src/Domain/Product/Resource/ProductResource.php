<?php

namespace Domain\Product\Resource;

use Support\Traits\MakeResourceMethod;

class ProductResource {
    use MakeResourceMethod;

    public static function resource(mixed $entity): array {
        return [
            "ID" => $entity->attributes['id'],
            "NOME" => $entity->attributes['name'],
            "VLRUNIT" => (float)$entity->attributes['unit_value'],
            "CRIADO_EM" => dateFormat($entity->attributes['created_at']),
            "ATUALIZADO_EM" => dateFormat($entity->attributes['updated_at']),
        ];
    }
}