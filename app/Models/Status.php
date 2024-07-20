<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(string[] $status)
 * @method static get()
 * @property int $id
 * @property string $name
 */
class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }

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
}
