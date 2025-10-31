<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Response;
use App\Models\Recommendation;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class DecisionTreeService
{
    /**
     * Predict & persist for a single user, using direct features array.
     */
        public function predictForUserWithFeatures(int $userId, array $features): void
        {
            $resp = $this->http->post('predict', [
                'json' => ['features' => $features],
            ]);
            $scores = json_decode($resp->getBody()->getContents(), true);

            DB::transaction(function () use ($userId, $scores) {
                Recommendation::where('user_id', $userId)->delete();
                foreach ($scores as $fieldId => $score) {
                    Recommendation::create([
                        'user_id'       => $userId,
                        'tech_field_id' => (int) $fieldId,
                        'score'         => (float) $score,
                    ]);
                }
            });
        }
    protected Client $http;

    public function __construct()
    {
        $this->http = new Client([
            'base_uri' => rtrim(env('DTREE_API', 'http://127.0.0.1:5001'), '/').'/',
            'timeout'  => 10.0,
        ]);
    }

    /**
     * Retrain on all responses by POSTing a JSON matrix to /train.
     */
    public function retrain(): void
    {
        // Build the payload exactly as the Flask /train endpoint expects:
        $matrix = $this->pivotResponses();

        $this->http->post('retrain', [
            'json' => [
                'data' => $matrix
            ],
        ]);
    }

    /**
     * Predict & persist for a single user.
     */
    public function predictForUser(int $userId): void
    {
        $features = Response::where('user_id', $userId)
            ->orderBy('question_id')
            ->pluck('value')
            ->map(fn($v) => (float) $v)
            ->values()
            ->all();

        $resp   = $this->http->post('predict', [
            'json' => ['features' => $features],
        ]);
        $scores = json_decode($resp->getBody()->getContents(), true);

        DB::transaction(function () use ($userId, $scores) {
            Recommendation::where('user_id', $userId)->delete();
            foreach ($scores as $fieldId => $score) {
                Recommendation::create([
                    'user_id'       => $userId,
                    'tech_field_id' => (int) $fieldId,
                    'score'         => (float) $score,
                ]);
            }
        });
    }

    /**
     * Build the matrix payload for /train.
     * Returns:
     * [
     *   'columns' => ['Q1','Q2',…,'tech_field_id'],
     *   'data'    => [
     *       [3.0,5.0,…,2],
     *       [4.0,1.0,…,7],
     *       …
     *   ]
     * ]
     */
    protected function pivotResponses(): array
    {
        // 1) Grab question IDs in order
        $questionIds = Question::orderBy('id')->pluck('id')->all();

        // 2) Group all responses by user
        $answersByUser = Response::select('user_id','question_id','value')
            ->whereIn('question_id', $questionIds)
            ->get()
            ->groupBy('user_id');

        // 3) Final labels per user
        $labels = Recommendation::pluck('tech_field_id','user_id');

        // 4) Assemble each row
        $rows = [];
        foreach ($answersByUser as $userId => $answers) {
            if (! isset($labels[$userId])) {
                continue; // skip if no final recommendation yet
            }
            $row = [];
            foreach ($questionIds as $qid) {
                $resp = $answers->firstWhere('question_id',$qid);
                $row[] = $resp ? (float)$resp->value : null;
            }
            $row[] = (int)$labels[$userId];
            $rows[] = $row;
        }

        // 5) Return in the shape the Python service expects
        return [
            'columns' => array_merge(
                array_map(fn($id) => "Q{$id}", $questionIds),
                ['tech_field_id']
            ),
            'data'    => $rows,
        ];
    }
}
