<?php

namespace App\Contracts\Repositories;

use App\Models\Entities\DriverEntity;

/**
 * Interface DriverRepositoryInterface
 * @package App\Contract\Repositories
 */
interface DriverRepositoryInterface
{
    /**
     * Find all entities
     *
     * @return array of DriverEntity objects
     */
    public function all(): array;

    /**
     * Find entity by its Id
     *
     * @param mixed $id
     * @return null|DriverEntity
     */
    public function findById($id): ?DriverEntity;

    /**
     * Create an entity
     *
     * @param DriverEntity $entity
     * @return bool
     */
    public function create(DriverEntity &$entity): bool;
}