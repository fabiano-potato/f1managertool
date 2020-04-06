<?php

namespace App\Models\Mappers;

use App\Models\Entities\AbstractEntity;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface MapperInterface
 * @package App\Models\Mappers
 */
interface MapperInterface
{
    /**
     * Map the Eloquent model to it's entity
     *
     * @param Model $model
     * @return Model
     */
    public function toEntity(Model $model, AbstractEntity $entity);

    /**
     * Map an array of models to an array of entities
     *
     * @param array $models
     * @return array
     */
    public function toEntities(array $models): array;

    /**
     * Map an entity to an Eloquent Model
     *
     * @param AbstractEntity $entity
     * @return Model
     */
    public function toModel(AbstractEntity $entity, Model $model): Model;
}
