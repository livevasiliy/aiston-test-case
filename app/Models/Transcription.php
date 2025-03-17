<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transcription extends Model
{
    /** @use HasFactory<\Database\Factories\TranscriptionFactory> */
    use HasFactory;

    protected $table = 'transcriptions';

    protected $fillable = [
        'task_id',
        'data'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
