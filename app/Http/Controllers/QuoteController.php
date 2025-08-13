<?php

namespace App\Http\Controllers;

use App\Services\QuoteService;
use Illuminate\Http\JsonResponse;

class QuoteController extends Controller
{
    protected QuoteService $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function random(): JsonResponse
    {
        $quote = $this->quoteService->getRandomQuote();

        if (!$quote) {
            return response()->json(['error' => 'Unable to fetch quote'], 500);
        }

        return response()->json($quote);
    }
}
