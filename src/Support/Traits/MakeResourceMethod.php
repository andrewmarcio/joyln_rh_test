<?php

namespace Support\Traits;

trait MakeResourceMethod {
    
    public static function resource(array $resource): array {
        return $resource;
    } 
    
    public static function collection(array $resources): array {
        return array_map(function($entity) {
            return self::resource($entity);
        }, $resources);
    }

    public static function make(mixed $entity): array {
        return self::resource($entity);
    }
}