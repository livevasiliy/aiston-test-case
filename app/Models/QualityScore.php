<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualityScore extends Model
{
    /** @use HasFactory<\Database\Factories\QualityAssessmentFactory> */
    use HasFactory;

    protected $table = 'quality_scores';

    protected $fillable = [
        'task_id',
        'data'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
