<?php

namespace App\Contracts\Repositories;

use App\Models\Entities\UserCarComponentEntity;

/**
 * Interface UserCarComponentRepositoryInterface
 * @package App\Contract\Repositories
 */
interface UserCarComponentRepositoryInterface
{
    /**
     * Find all entities
     *
     * @return array of UserCarComponentEntity objects
     */
    public function all(): array;

    /**
     * Find entity by its Id
     *
     * @param mixed $id
     * @return null|UserCarComponentEntity
     */
    public function findById($id): ?UserCarComponentEntity;

    /**
     * Create an entity
     *
     * @param UserCarComponentEntity $entity
     * @return bool
     */
    public function create(UserCarComponentEntity &$entity): bool;
}
