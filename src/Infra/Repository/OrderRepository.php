<?php

namespace Infra\Repository;

use Domain\Order\Entity\Order;
use Infra\Repository\Interfaces\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected mixed $model = Order::class;
}
