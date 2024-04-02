<?php

namespace Domain\Product\Entity;

use Domain\Base\Entity\BaseEntity;

class Product extends BaseEntity {

    protected string $table = 'products';

    protected array $properties = [
        "name",
        "unit_value"
    ];
}