<?php

declare(strict_types=1);


namespace App\Service;

class QualityAssessmentService
{
    public function assessQuality($transcription): array
    {
        // Возвращаем фейковые данные оценки
        return [
            'quality_score' => rand(1, 10),
            'comments' => 'Фейковая оценка качества.'
        ];
    }
}
