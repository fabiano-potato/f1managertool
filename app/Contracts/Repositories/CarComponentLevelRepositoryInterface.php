<?php

namespace App\Contracts\Repositories;

use \App\Models\Entities\CarComponentLevelEntity;
use App\Repositories\Eloquent\CarComponentLevelRepository;

/**
 * Interface CarComponentLevelRepositoryInterface
 * @package App\Contracts\Repositories
 */
interface CarComponentLevelRepositoryInterface
{
    /**
     * Find entities
     *
     * @return array of CarComponentEntity objects
     */
    public function find(): array;

    /**
     * Find entity by it's Id
     *
     * @param int $id
     * @return null|CarComponentLevelEntity
     */
    public function findById(int $id): ?CarComponentLevelEntity;

    /**
     * Create an entity
     *
     * @param CarComponentLevelEntity $entity
     * @return bool
     */
    public function create(CarComponentLevelEntity &$entity): bool;

    /**
     * Set whether to include the parent CarComponent in the returned entities.
     * Defaults to true.
     *
     * @param bool $include
     * @return CarComponentLevelRepository
     */
    public function includeCarComponent($include = true): CarComponentLevelRepository;
}
