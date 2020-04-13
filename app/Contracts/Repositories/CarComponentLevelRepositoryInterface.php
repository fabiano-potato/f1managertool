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
     * @return array of CarComponentLevelEntity objects
     */
    public function all(): array;

    /**
     * Get the first result from all()
     *
     * @return CarComponentLevelEntity
     */
    public function findOne(): ?CarComponentLevelEntity;

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
     * Add query filter on car_component_id
     *
     * @param array|int $filterValue
     * @return CarComponentLevelRepository
     */
    public function filterByCarComponentId($filterValue): CarComponentLevelRepository;

    /**
     * Add query filter on level
     *
     * @param array|int $filterValue
     * @return CarComponentLevelRepository
     */
    public function filterByLevel($filterValue): CarComponentLevelRepository;
}
