<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pipeline\Pipeline;

/**
 * @method static get()
 * @method static create(array $data)
 * @method static find(int $id)
 * @method static paginate(int $int)
 * @method static findOrFail(int $id)
 * @property string subject
 * @property int project_id
 * @property int priority_id
 * @property int status_id
 */
class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'project_id',
        'priority_id',
        'status_id'
    ];

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getProjectId(): int
    {
        return $this->project_id;
    }

    public function setProjectId(int $project_id): void
    {
        $this->project_id = $project_id;
    }

    public function getPriorityId(): int
    {
        return $this->priority_id;
    }

    public function setPriorityId(int $priority_id): void
    {
        $this->priority_id = $priority_id;
    }

    public function getStatusId(): int
    {
        return $this->status_id;
    }

    public function setStatusId(int $status_id): void
    {
        $this->status_id = $status_id;
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public static function filtered()
    {
        return app(Pipeline::class)
            ->send(Issue::query())
            ->through([
                \App\QueryFilters\IssueId::class,
                \App\QueryFilters\ProjectId::class,
                \App\QueryFilters\StatusId::class,
                \App\QueryFilters\Sort::class,
            ])
            ->thenReturn();
    }
}
