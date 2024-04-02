<?php

namespace Domain\Client\Resource;

use Support\Traits\MakeResourceMethod;

class ClientResource {
    use MakeResourceMethod;

    public static function resource(mixed $entity): array {
        return [
            "ID" => $entity->attributes['id'],
            "NOME" => $entity->attributes['name'],
            "CIDADE_NOME" => $entity->attributes['city'],
            "CRIADO_EM" => dateFormat($entity->attributes['created_at']),
            "ATUALIZADO_EM" => dateFormat($entity->attributes['updated_at']),
        ];
    }
}