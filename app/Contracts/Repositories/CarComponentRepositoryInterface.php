<?php

namespace App\Contracts\Repositories;

use App\Models\Entities\CarComponentEntity;
use App\Repositories\Eloquent\CarComponentRepository;

/**
 * Interface CarComponentRepositoryInterface
 * @package App\Contract\Repositories
 */
interface CarComponentRepositoryInterface
{
    /**
     * Find all entities
     *
     * @return array of CarComponentEntity objects
     */
    public function all(): array;

    /**
     * Find entity by it's Id
     *
     * @param mixed $id
     * @return null|CarComponentEntity
     */
    public function findById($id): ?CarComponentEntity;

    /**
     * Create an entity
     *
     * @param CarComponentEntity $entity
     * @return bool
     */
    public function create(CarComponentEntity &$entity): bool;

    /**
     * Whether to include and return the child CarComponentLevel entities
     *
     * @param bool $include
     * @return CarComponentRepository
     */
    public function includeCarComponentLevels($include = false): CarComponentRepository;
}
