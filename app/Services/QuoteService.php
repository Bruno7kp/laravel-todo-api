<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QuoteService
{
    protected string $baseUrl = 'https://zenquotes.io/api';

    public function getRandomQuote()
    {
        $response = Http::get("{$this->baseUrl}/random");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
