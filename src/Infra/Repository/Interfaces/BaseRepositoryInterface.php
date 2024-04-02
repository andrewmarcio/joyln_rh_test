<?php

namespace Infra\Repository\Interfaces;

interface BaseRepositoryInterface
{
    public function list(): mixed;
    public function findById(int $id): mixed;
    public function create(array $payload): mixed;
    public function update(int $id, array $payload): mixed;
    public function destroy(int $id): void;
}
