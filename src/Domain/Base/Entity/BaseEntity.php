<?php

namespace Domain\Base\Entity;

use Infra\Persistence\ORM;
use InvalidArgumentException;

class BaseEntity extends ORM
{
    public array $attributes;

    public function __set($name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name): mixed
    {
        if (!array_key_exists($name, $this->attributes))
            throw new InvalidArgumentException("Unknown property $name");

        return $this->attributes[$name];
    }
}
