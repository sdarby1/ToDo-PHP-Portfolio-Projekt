<?php

namespace App\Traits;

use App\Helpers\Str;

trait RepresentsDatabaseEntry {
    public function setColumnsAsProperties(array $data = [])
    {
        foreach ($data as $column => $value) {
            $propertyName = Str::toCamelCase($column);
            if (property_exists($this, $propertyName)) {
                $this->{$propertyName} = $value;
            }
        }
    }
}
