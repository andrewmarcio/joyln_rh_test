<?php

namespace Application\Services;

use Domain\Client\Resource\ClientResource;
use Infra\Repository\ClientRepository;

class ClientService
{
    public function __construct(
        private ClientRepository $repository = new ClientRepository()
    ) {
    }

    public function index(): array
    {
        return ClientResource::collection($this->repository->list());
    }

    public function find(int $id): array
    {
        return ClientResource::make($this->repository->findById($id));
    }

    public function create(array $payload): array
    {
        return ClientResource::make($this->repository->create(payload: $payload));
    }

    public function update(int $id, array $payload): array
    {
        return ClientResource::make($this->repository->update($id, $payload));
    }

    public function delete(int $id): void
    {
        $this->repository->destroy($id);
    }
}
