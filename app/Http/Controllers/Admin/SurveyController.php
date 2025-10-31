<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSurveyResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display survey analytics and results
     */
    public function index()
    {
        // Basic stats
        $totalResponses = UserSurveyResponse::count();
        $totalUsers = User::count();
        $responseRate = $totalUsers > 0 ? round(($totalResponses / $totalUsers) * 100, 1) : 0;
        
        // Satisfaction breakdown
        $satisfactionBreakdown = UserSurveyResponse::select('satisfaction_rating', DB::raw('count(*) as count'))
            ->groupBy('satisfaction_rating')
            ->orderBy('satisfaction_rating')
            ->get()
            ->pluck('count', 'satisfaction_rating')
            ->toArray();
        
        // Fill missing ratings with 0
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($satisfactionBreakdown[$i])) {
                $satisfactionBreakdown[$i] = 0;
            }
        }
        ksort($satisfactionBreakdown);
        
        // Average satisfaction
        $avgSatisfaction = UserSurveyResponse::avg('satisfaction_rating') ?? 0;
        
        // Recommendation stats
        $recommendStats = UserSurveyResponse::select('would_recommend', DB::raw('count(*) as count'))
            ->groupBy('would_recommend')
            ->get()
            ->pluck('count', 'would_recommend')
            ->toArray();
        
        $recommendYes = $recommendStats[1] ?? 0;
        $recommendNo = $recommendStats[0] ?? 0;
        $recommendRate = $totalResponses > 0 ? round(($recommendYes / $totalResponses) * 100, 1) : 0;
        
        // Recent feedback
        $recentFeedback = UserSurveyResponse::with('user')
            ->whereNotNull('feedback')
            ->where('feedback', '!=', '')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
        
        // Monthly trend (last 6 months)
        $monthlyTrend = UserSurveyResponse::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('count(*) as count'),
                DB::raw('AVG(satisfaction_rating) as avg_rating')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // All survey responses with pagination for table display
        $allSurveys = UserSurveyResponse::with('user')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.surveys.index', compact(
            'totalResponses',
            'totalUsers', 
            'responseRate',
            'satisfactionBreakdown',
            'avgSatisfaction',
            'recommendYes',
            'recommendNo',
            'recommendRate',
            'recentFeedback',
            'monthlyTrend',
            'allSurveys'
        ));
    }

    /**
     * Export survey data as CSV
     */
    public function export()
    {
        $surveys = UserSurveyResponse::with('user')
            ->orderByDesc('created_at')
            ->get();

        $filename = 'survey_responses_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($surveys) {
            $handle = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($handle, [
                'ID',
                'User Name',
                'User Email', 
                'Satisfaction Rating',
                'Would Recommend',
                'Feedback',
                'Improvements',
                'Submitted At'
            ]);
            
            // CSV data
            foreach ($surveys as $survey) {
                fputcsv($handle, [
                    $survey->id,
                    $survey->user->name ?? 'N/A',
                    $survey->user->email ?? 'N/A',
                    $survey->satisfaction_rating,
                    $survey->would_recommend ? 'Yes' : 'No',
                    $survey->feedback ?? '',
                    $survey->improvements ?? '',
                    $survey->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete a survey response
     */
    public function destroy(UserSurveyResponse $survey)
    {
        $survey->delete();
        
        return back()->with('success', 'Survey response deleted successfully.');
    }
}
