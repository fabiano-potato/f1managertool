<?php

namespace App\Contracts\Repositories;

use App\Models\Entities\UserCarComponentEntity;
use App\Repositories\Eloquent\UserCarComponentRepository;

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

    /**
     * Filter query by userId
     *
     * @param int $userId
     * @return UserCarComponentRepository
     */
    public function filterUserId(int $userId): UserCarComponentRepository;

    /**
     * Filter query by car_component_type
     *
     * @param int $type
     * @return UserCarComponentRepository
     */
    public function filterCarComponentType(int $type): UserCarComponentRepository;
}
