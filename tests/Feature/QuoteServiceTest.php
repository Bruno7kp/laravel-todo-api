<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\QuoteService;

class QuoteServiceTest extends TestCase
{
    public function it_returns_random_quote_from_api()
    {
        // Simula a resposta da API
        $fakeResponse = [
            [
                'q' => 'Be yourself; everyone else is already taken.',
                'a' => 'Oscar Wilde',
                'h' => '<blockquote>&ldquo;Be yourself; everyone else is already taken.&rdquo; &mdash; <footer>Oscar Wilde</footer></blockquote>'
            ]
        ];

        Http::fake([
            'zenquotes.io/api/random' => Http::response($fakeResponse, 200)
        ]);

        $service = new QuoteService();
        $result = $service->getRandomQuote();

        $this->assertIsArray($result);
        $this->assertEquals($fakeResponse, $result);
        $this->assertEquals('Oscar Wilde', $result[0]['a']);
    }
}
