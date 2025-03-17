<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'task_id',
        'metadata'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
