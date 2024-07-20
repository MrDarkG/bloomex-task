<?php

namespace App\QueryFilters;

class ProjectId extends Filters
{
    protected function applyFilter($builder)
    {
        $search=request($this->filterName());
        return $builder->where("project_id",$search);
    }
}
