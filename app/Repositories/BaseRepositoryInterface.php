<?php

namespace App\Repositories;

use App\Models\Entities\AbstractEntity;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    /**
     * Find entities
     *
     * @param array $filters
     * @return array of Entity objects
     */
    public function find($filters = []) : array;

    /**
     * Find entity by it's Id
     *
     * @param $id
     * @return null|AbstractEntity
     */
    public function findById($id);

    /**
     * Create an entity
     *
     * @param AbstractEntity $entity
     * @return bool
     */
    public function create(&$entity): bool;
}
