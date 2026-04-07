<?php

namespace App\Services;

use \Exception;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected string $modelUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');

        $this->modelUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$this->apiKey}";
    }

    public function generateInsights($prompt): string
    {
        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ];

         $response = Http::withHeaders([
            "Content-Type" => "application/json"
        ])->post($this->modelUrl, $payload);

        if ($response->successful()) {
            return $response->json()['candidates'][0]['content']['parts'][0]['text']
                ?? "No insights generated.";
        }

        throw new Exception(
            "Gemini API Failed: {$response->status()} - {$response->body()}"
        );
    }
}
