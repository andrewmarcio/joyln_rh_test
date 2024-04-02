<?php

namespace Infra\Repository;

use Domain\Product\Entity\Product;
use Infra\Repository\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected mixed $model = Product::class;
}
