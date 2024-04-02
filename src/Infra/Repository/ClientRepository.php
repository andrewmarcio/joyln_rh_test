<?php

namespace Infra\Repository;

use Domain\Client\Entity\Client;
use Infra\Repository\Interfaces\ClientRepositoryInterface;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    protected mixed $model = Client::class;
}
