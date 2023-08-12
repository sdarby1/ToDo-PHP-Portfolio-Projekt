<?php

trait RepresentsDatabaseEntry {
    public function setColumnsAsProperties(array $data = [])
    {
        foreach ($data as $column => $value) {
            $column = Str::toCamelCase($column);
            $this->{$column} = $value;
        }
    }
}