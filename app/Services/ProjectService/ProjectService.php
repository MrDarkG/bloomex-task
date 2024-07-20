<?php

namespace App\Services\ProjectService;

use App\Models\Project;

class ProjectService
{
    public function get()
    {
        return Project::get();
    }
}
