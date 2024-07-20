<?php

namespace App\Http\Resources\Redmine;

use App\Http\Resources\Redmine\Issues\IssueResource;
use App\Http\Resources\Redmine\Priority\PriorityResource;
use App\Http\Resources\Redmine\Projects\ProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RedmineResource
{
    public string $resourceName;

    public function __construct(string $resourceName)
    {
        $this->resourceName = $resourceName;
    }

    public function collection($data): JsonResource|array|null
    {
        return match ($this->resourceName) {
            'issues' => ["data" => IssueResource::collection($data)],
            'projects' => ProjectResource::collection($data),
            'priorities' => PriorityResource::collection($data),
            default => $data,
        };
    }

    public function single($data): JsonResource|array|null
    {
        return match ($this->resourceName) {
            'issues' => new IssueResource($data),
            'projects' => new ProjectResource($data),
            'priorities' => new PriorityResource($data),
            default => new JsonResource($data),
        };
    }
}
