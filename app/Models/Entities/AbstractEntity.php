<?php

namespace App\Models\Entities;

use JsonSerializable;

abstract class AbstractEntity implements JsonSerializable
{
    /**
     * Update this entity's data from array using setter methods.
     *
     * @param array $data
     */
    public function fromArray(array $data)
    {
        foreach ($data as $k => $v) {
            $setterName = 'set' . ucfirst($k);
            if (method_exists(static::class, $setterName)) {
                $this->$setterName($v);
            }
        }
    }

    /**
     * Convert entity to array
     *
     * @return array
     */
    public function toArray(): array
    {
        $results = [];

        foreach (get_object_vars($this) as $k => $v) {
            // Remove the underscore from the property names
            $results[trim($k, '_')] = $v;
        }

        return $results;
    }

    /**
     * Return array to be serialised to JSON
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
