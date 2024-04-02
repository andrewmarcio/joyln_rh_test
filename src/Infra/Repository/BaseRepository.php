<?php

namespace Infra\Repository;

use Domain\Base\Entity\BaseEntity;
use Infra\Repository\Interfaces\BaseRepositoryInterface;
use Support\Handler\EntityNotFound;

class BaseRepository implements BaseRepositoryInterface
{
    protected mixed $model;

    protected function resolvedModel(): BaseEntity
    {
        return new $this->model;
    }

    public function list(): mixed
    {
        return $this->resolvedModel()->get();
    }

    public function findById(int $id): mixed
    {
        return $this->resolvedModel()->where('id', '=', $id)->first();
    }
    public function create(array $payload): mixed
    {
        return $this->resolvedModel()->create(data: $payload);
    }

    public function update(int $id, array $payload): mixed
    {
        $entity = $this->findById($id);
        if (!count(get_object_vars($entity))) {
            throw new EntityNotFound();
        }
        return $this->resolvedModel()->update($entity->attributes['id'], $payload);
    }
    
    public function destroy(int $id): void
    {
        $this->resolvedModel()->delete($id);
    }
}
