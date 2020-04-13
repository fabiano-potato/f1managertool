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
     * Get the first result from all()
     *
     * @return UserCarComponentEntity
     */
    public function findOne(): ?UserCarComponentEntity;

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
     * @param mixed $userId int or array of ids to filter by
     * @return UserCarComponentRepository
     */
    public function filterUserId($userId): UserCarComponentRepository;

    /**
     * Filter query by car_component_type
     *
     * @param mixed $type int or array of types to filter by
     * @return UserCarComponentRepository
     */
    public function filterCarComponentType($type): UserCarComponentRepository;

    /**
     * Filter result(s) by car_component_id
     *
     * @param mixed $id int or array of ids to filter by
     * @return UserCarComponentRepository
     */
    public function filterCarComponentId($id): UserCarComponentRepository;

    /**
     * Unassign any preexisting CarComponents for the given type
     *
     * @param $userId
     * @param $type
     * @return UserCarComponentRepository
     */
    public function unassignComponentsForType(int $userId, int $type): UserCarComponentRepository;

    /**
     * Update an existing UserCarComponentEntity
     *
     * @param UserCarComponentEntity $entity
     * @return bool
     */
    public function update(UserCarComponentEntity &$entity): bool;
}
