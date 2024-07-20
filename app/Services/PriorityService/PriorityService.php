<?php

namespace App\Services\PriorityService;

use App\Models\Priority;

class PriorityService
{
    public function get()
    {
        return Priority::get();
    }
}
