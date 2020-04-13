<?php

namespace App\Contracts\Repositories;

use App\Models\Entities\DriverLevelEntity;

/**
 * Interface DriverLevelRepositoryInterface
 * @package App\Contract\Repositories
 */
interface DriverLevelRepositoryInterface
{
    /**
     * Find all entities
     *
     * @return array of DriverLevelEntity objects
     */
    public function all(): array;

    /**
     * Get the first entity from an all() result
     *
     * @return DriverLevelEntity|null
     */
    public function findOne(): ?DriverLevelEntity;

    /**
     * Find entity by its Id
     *
     * @param mixed $id
     * @return null|DriverLevelEntity
     */
    public function findById(int $id): ?DriverLevelEntity;

    /**
     * Create an entity
     *
     * @param DriverLevelEntity $entity
     * @return bool
     */
    public function create(DriverLevelEntity &$entity): bool;
}
