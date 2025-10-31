<?php
// app/Http/Controllers/Admin/SystemDataController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DecisionTreeService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SystemDataController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.system.dashboard', [
            'userCount'           => \App\Models\User::count(),
            'questionCount'       => \App\Models\Question::count(),
            'responseCount'       => \App\Models\Response::count(),
            'recommendationCount' => \App\Models\Recommendation::count(),
            'techFieldCount'      => \App\Models\TechField::count(),
        ]);
    }

    public function retrain(Request $request, DecisionTreeService $dtree)
    {
        $start = microtime(true);

        try {
            $dtree->retrain();
            $duration = microtime(true) - $start;

            if ($request->wantsJson()) {
                return response()->json([
                    'status'   => 'success',
                    'duration' => round($duration, 2),
                    'message'  => "Model retrained in {$duration}s",
                ]);
            }

            return redirect()
                ->route('admin.system.dashboard')
                ->with('status', "✅ Model retrained in ".round($duration,2)." seconds");
        } catch (\Throwable $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => $e->getMessage(),
                ], 500);
            }

            report($e);
            return redirect()
                ->route('admin.system.dashboard')
                ->withErrors('Retraining failed: '.$e->getMessage());
        }
    }
}
