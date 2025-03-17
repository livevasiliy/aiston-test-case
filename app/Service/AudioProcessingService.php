<?php

declare(strict_types=1);


namespace App\Service;

class AudioProcessingService
{
    public function processAudio(string $audioUrl): array
    {
        // Имитация задержки
        sleep(2);
        return [
            [
                "speaker" => "S1",
                "start" => 0.0,
                "end" => 5.0,
                "text" => "Добрый день, как я могу помочь?"
            ],
            [
                "speaker" => "S2",
                "start" => 5.0,
                "end" => 10.0,
                "text" => "Здравствуйте, у меня проблема с заказом."
            ]
        ];
    }
}
