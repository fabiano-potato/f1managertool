<?php

namespace App\Models\Entities;

class AbstractEntity
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
}
