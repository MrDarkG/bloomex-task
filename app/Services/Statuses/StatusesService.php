<?php

namespace App\Services\Statuses;

use App\Models\Status;

class StatusesService
{
    public function get()
    {
        return Status::get();
    }
}
