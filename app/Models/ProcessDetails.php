<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcessDetails extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'process_id',
        'tools',
        'responsibles',
        'documentation_url',
    ];

    public function process(): BelongsTo
    {
        return $this->belongsTo(Process::class);
    }
}
