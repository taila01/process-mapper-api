<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\ProcessDetails;

/**
 * @method static \Illuminate\Database\Eloquent\Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static \Illuminate\Database\Eloquent\Model|static create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Model|static|null find(mixed $id)
 */
class Process extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'sector_id',
        'parent_id',
        'name',
        'description',
        'type',
        'status',
    ];

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Process::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Process::class, 'parent_id');
    }

    public function details(): HasOne
    {
        return $this->hasOne(ProcessDetails::class);
    }
}
