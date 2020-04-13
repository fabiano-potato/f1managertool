<?php

namespace App\Repositories\Eloquent;

use App\Models\Mappers\Eloquent\AbstractEloquentMapper;
use App\Models\Entities\AbstractEntity;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractEloquentRepository
{
    /**
     * @var AbstractEloquentMapper|null
     */
    protected $_mapper = null;

    /**
     * Create the entity
     *
     * @param AbstractEntity $entity
     * @return bool
     */
    protected function _create(&$entity): bool
    {
        // Ensure we creating from a new instance of model
        $model = $this->_mapper->toModel($entity);
        $result = $model->save();

        if ($result) {
            // Update the entity with saved model data (e.g primary key, timestamps)
            $entity = $this->_mapper->toEntity($model, $entity);
        }
        else {
            throw new \RuntimeException('Failed saving new entity.');
        }

        return $result;
    }

    /**
     * Filter the $query with a whitelist of values for a column
     *
     * @param Builder $query (passed by reference)
     * @param $dbColumnName
     * @param $filterValue
     */
    protected function _filter(Builder &$query, $dbColumnName, $filterValue): void
    {
        if (!$filterValue) {
            return;
        }
        if (is_array($filterValue)) {
            $query->whereIn($dbColumnName, $filterValue);
        }
        else {
            $query->where($dbColumnName, $filterValue);
        }
    }

    /**
     * Filter the $query by excluding the values in a column
     *
     * @param Builder $query (passed by reference)
     * @param $dbColumnName
     * @param $filterValue
     */
    protected function _filterNot(Builder &$query, $dbColumnName, $filterValue): void
    {
        if (!$filterValue) {
            return;
        }
        if (is_array($filterValue)) {
            $query->whereNotIn($dbColumnName, $filterValue);
        }
        else {
            $query->where($dbColumnName, '<>', $filterValue);
        }
    }

    /**
     * Apply filters to query. Assumes the filter_key is the same as the db column name.
     *
     * @param Builder $query
     * @return $this
     */
    protected function _applyFilters(Builder &$query): self
    {
        // TODO: Update filtering to handle different types of filters. E.g. not* gt/lt etc
        foreach ($this->_filters as $k => $v) {
            $this->_filter($query, $k, $v);
        }
        return $this;
    }
}
