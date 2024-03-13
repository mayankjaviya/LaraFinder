<?php

namespace mayankjaviya\LaraFinder;

use Illuminate\Support\Arr;

class LaraFinder
{

    public static function search($model, $value, $columns = [])
    {

        static::checkClass($model);
        $model = new $model;

        $columns = Arr::wrap($columns);
        if (empty($columns)) {
            throw new \Exception('Column(s) are required');
        }

        static::checkColumns($model, $columns);

        $result = $model::where(function ($query) use ($columns, $value) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $value . '%');
            }
        })->get();

        return $result;
    }

    public static function searchAll($model, $value)
    {
        static::checkClass($model);
        $model = new $model;

        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        $result = $model::where(function ($query) use ($columns, $value) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $value . '%');
            }
        })->get();

        return $result;
    }

    public static function searchAllExcept($model, $value, $except)
    {

        static::checkClass($model);
        $model = new $model;

        static::checkColumns($model, $except);

        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        $columns = array_diff($columns, Arr::wrap($except));
        $result = $model::where(function ($query) use ($columns, $value) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $value . '%');
            }
        })->get();

        return $result;
    }

    public static function searchableColumns($model, $value, $columns = [])
    {
        static::checkClass($model);
        $model = new $model;

        $columns = Arr::wrap($columns);

        static::checkColumns($model, $columns);

        if (empty($columns)) {
            $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        }

        $result = [];
        foreach ($columns as $col) {
            $result[$col] = $model::where($col, 'LIKE', '%' . $value . '%')->get();
        }

        return $result;
    }

    private static function checkColumns($model, $columns = [])
    {
        // check if columns exist in the table
        $allColumns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        // fetch column which is not in the table
        $columns = Arr::wrap($columns);
        $notExist = array_diff($columns, $allColumns);

        if (!empty($notExist)) {
            throw new \Exception('Column(s) "' . implode(', ', $notExist) . '" does not exist in the "' . $model->getTable() . '" table');
        }
    }

    private static function checkClass($model)
    {
        if (!class_exists($model)) {
            throw new \Exception('Model does not exist');
        }
    }
}
