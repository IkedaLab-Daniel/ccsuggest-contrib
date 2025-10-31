<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
  
    public function index()
    {
        $recommendations = Recommendation::with('techField')
            ->where('user_id', Auth::id())
            ->orderByDesc('score')
            ->get();

        return view('recommendations.index', compact('recommendations'));
    }

    /**
     * Download the recommendations as a PDF.
     *
     * GET /recommendations/download
     */
    public function download()
    {
        $recommendations = Recommendation::with('techField')
            ->where('user_id', Auth::id())
            ->orderByDesc('score')
            ->get();

        // Using barryvdh/laravel-dompdf (for example)
        $pdf = \PDF::loadView('recommendations.pdf', compact('recommendations'));
        return $pdf->download('recommendations.pdf');
    }
}
