<?php

namespace App\Http\Resources\Issues;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $subject
 * @property Project $project
 * @property Priority $priority
 * @property Status $status
 */
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
            'id' => $this->id,
            'subject' => $this->subject,
            'project' => $this->project->getName(),
            'project_id' => $this->project->getId(),
            'priority' => $this->priority->getName(),
            'priority_id' => $this->priority->getId(),
            'status' => $this->status->getName(),
            'status_id' => $this->status->getId(),
        ];
    }
}
