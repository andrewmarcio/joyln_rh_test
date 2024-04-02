<?php

namespace Application\Services;

use Domain\Product\Resource\ProductResource;
use Infra\Repository\ProductRepository;

class ProductService
{
    public function __construct(
        private ProductRepository $repository = new ProductRepository()
    ) {
    }

    public function index(): array
    {
        return ProductResource::collection($this->repository->list());
    }

    public function find(int $id): array
    {
        return ProductResource::make($this->repository->findById($id));
    }

    public function create(array $payload): array
    {
        return ProductResource::make($this->repository->create(payload: $payload));
    }

    public function update(int $id, array $payload): array
    {
        return ProductResource::make($this->repository->update($id, $payload));
    }

    public function delete(int $id): void
    {
        $this->repository->destroy($id);
    }
}
