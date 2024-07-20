<?php

namespace App\QueryFilters;

class IssueId extends Filters
{
    protected function applyFilter($builder)
    {
        $search=request($this->filterName());
        return $builder->where("id",$search);
    }
}
