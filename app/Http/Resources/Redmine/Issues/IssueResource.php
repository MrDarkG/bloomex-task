<?php

namespace App\Http\Resources\Redmine\Issues;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class IssueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource['id'],
            'subject' => $this->resource['subject'],
            'project' => $this->resource['project']['name'],
            'project_id' => $this->resource['project']['id'],
            'priority' => $this->resource['priority']['name'],
            'priority_id' => $this->resource['priority']['id'],
            'status' => $this->resource['status']['name'],
            'status_id' => $this->resource['status']['id']
        ];
    }
}
