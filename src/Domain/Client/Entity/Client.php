<?php

namespace Domain\Client\Entity;

use Domain\Base\Entity\BaseEntity;

class Client extends BaseEntity {

    protected string $table = 'clients';

    protected array $properties = [
        "name",
        "city",
    ];
}