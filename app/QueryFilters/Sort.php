<?php

namespace App\QueryFilters;


class Sort extends Filters
{
    protected function applyFilter($builder)
    {
        $search=request($this->filterName());

        $explode=explode(":",$search);
        $searchColumn=$explode[0];
        $searchColumn = in_array($searchColumn,
            [
                "id",
                "project_id",
                "priority_id",
                "status_id",
                "created_at",
                "updated_at"
            ]) ?
            $searchColumn : "id"
        ;

        $search = $explode[1] ?? "asc";
        return $builder->orderBy($searchColumn, $search);
    }
}
