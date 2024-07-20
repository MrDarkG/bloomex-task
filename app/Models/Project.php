<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(string[] $project)
 * @method static get()
 * @method static withCount(string $string)
 * @property int $id
 * @property string $name
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }
}
