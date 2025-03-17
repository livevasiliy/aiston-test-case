<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'status',
        'audio_url',
        'data'
    ];

    public function transcription(): HasOne
    {
        return $this->hasOne(Transcription::class);
    }

    public function qualityScore(): HasOne
    {
        return $this->hasOne(QualityScore::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
