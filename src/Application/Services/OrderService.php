<?php

namespace Application\Services;

use Domain\Order\Resource\OrderResource;
use Infra\Repository\OrderRepository;

class OrderService
{
    public function __construct(
        private OrderRepository $repository = new OrderRepository()
    ) {
    }

    public function index(): array
    {
        return OrderResource::collection($this->repository->list());
    }

    public function find(int $id): array
    {
        return OrderResource::make($this->repository->findById($id));
    }

    public function create(array $payload): array
    {
        return OrderResource::make($this->repository->create(payload: $payload));
    }

    public function update(int $id, array $payload): array
    {
        return OrderResource::make($this->repository->update($id, $payload));
    }

    public function delete(int $id): void
    {
        $this->repository->destroy($id);
    }
}
