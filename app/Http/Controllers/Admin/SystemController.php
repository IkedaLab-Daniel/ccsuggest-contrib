<?php
// app/Http/Controllers/Admin/SystemController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DecisionTreeService;
use Illuminate\Http\RedirectResponse;

class SystemController extends Controller
{
    public function retrain(DecisionTreeService $dtree): RedirectResponse
    {
        try {
            $dtree->retrain();
            return back()->with('status', 'Model retraining has started. Refresh in a few seconds to see updated recommendations.');
        } catch (\Throwable $e) {
            report($e); // logs the error
            return back()->withErrors('Retraining failed: '.$e->getMessage());
        }
    }
}
