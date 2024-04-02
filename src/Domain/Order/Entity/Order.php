<?php

namespace Domain\Order\Entity;

use Domain\Base\Entity\BaseEntity;

class Order extends BaseEntity {
    protected string $table = 'orders';

    protected array $properties = [
        "client_id",
        "items"
    ];
}