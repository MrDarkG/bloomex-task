<?php

namespace App\QueryFilters;

class StatusId extends Filters
{
    protected function applyFilter($builder)
    {
        $search=request($this->filterName());
        return $builder->where("status_id",$search);
    }
}
