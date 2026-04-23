<?php


namespace App\Http\Controllers\Student;      

use App\Http\Controllers\Controller;       
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentProfile;
use App\Models\Question;
use App\Models\Response;
use App\Models\User;
use App\Models\UserSurveyResponse;
use App\Services\DecisionTreeService;
use App\Models\TechField;

class StudentController extends Controller
{

   public function showQuestionnaire()
    {
        $jsQuestions = Question::with('options')
            ->get()
            ->map(fn($q) => [
                'id'      => $q->id,
                'text'    => $q->text,
                'type'    => $q->type,
                'options' => $q->options
                    ->map(fn($o) => [
                        'id'    => $o->id,
                        'value' => $o->value,
                        'text'  => $o->text,
                    ])
                    ->values(),
            ])
            ->values();

        return view('student.questionnaire', compact('jsQuestions'));
    }
   public function dashboard()
    {
        $user     = Auth::user();
        $profile  = $user->profile;
        $complete = $profile
                  && $profile->full_name
                  && $profile->date_of_birth
                  && $profile->gender
                  && $profile->gpa !== null
                  && $profile->senior_high_grade !== null
                  && ! empty($profile->interests);

        // pull all tech-fields
        $techFields = TechField::orderBy('name')->get();

        // define roadmaps for each field
        $roadmaps = [
          'Artificial Intelligence & ML' => array_merge(
            [
              'Introduction to Programming',
              'Data Structures & Algorithms',
              'Linear Algebra & Calculus',
              'Probability & Statistics',
              'AI Concepts & Ethics',
            ],
            [
              'Machine Learning Fundamentals',
              'Supervised & Unsupervised Learning',
              'Deep Learning',
              'Natural Language Processing',
              'Computer Vision',
              'Model Deployment & MLOps',
            ]
          ),
          'Blockchain' => [
            'Cryptography Essentials',
            'Distributed Ledger Concepts',
            'Consensus Mechanisms',
            'Smart Contracts with Solidity',
            'Ethereum & EVM Internals',
            'Decentralized Finance (DeFi) Basics',
            'NFTs & Token Standards',
            'Layer 2 Scaling Solutions',
            'Blockchain Security & Auditing',
            'Governance & Regulatory Considerations',
          ],
          'Cloud Computing' => [
            'Networking & Virtualization Fundamentals',
            'Linux Basics for Cloud',
            'Cloud Service Models (IaaS, PaaS, SaaS)',
            'AWS Core Services (EC2, S3, VPC)',
            'Azure or GCP Essentials',
            'Infrastructure as Code (Terraform)',
            'Containerization & Kubernetes',
            'Serverless Architectures',
            'Monitoring & Logging',
            'Cost Optimization & Security',
          ],
          'Data Science' => [
            'Statistics & Probability',
            'Data Wrangling (Python/R)',
            'Exploratory Data Analysis',
            'Data Visualization (Matplotlib, Tableau)',
            'Machine Learning Introduction',
            'Regression & Classification',
            'Clustering & Dimensionality Reduction',
            'Time Series Analysis',
            'Big Data Technologies',
            'Data Ethics & Privacy',
          ],
          'DevOps' => [
            'Linux & Scripting Fundamentals',
            'Version Control with Git',
            'CI/CD Concepts & Tools (Jenkins, GitHub Actions)',
            'Infrastructure as Code',
            'Containerization (Docker, Kubernetes)',
            'Monitoring & Alerting',
            'Logging & Observability',
            'Security & Compliance Automation',
            'Scalable System Design',
            'Chaos Engineering Basics',
          ],
          'Internet of Things' => [
            'Embedded Systems Fundamentals',
            'Microcontrollers & Circuit Design',
            'Sensors & Actuators',
            'Wireless Protocols (MQTT, BLE)',
            'Edge vs Cloud Computing',
            'IoT Data Processing & Analytics',
            'Security for IoT Devices',
            'Integration with Web/Mobile Apps',
            'Scaling & Deployment',
            'Maintenance & OTA Updates',
          ],
          'Mobile Development' => [
            'Programming Fundamentals (Swift, Kotlin)',
            'UI/UX for Mobile',
            'Cross-Platform Frameworks (Flutter, React Native)',
            'State Management',
            'Networking & API Integration',
            'Local Storage & Databases',
            'Performance Optimization',
            'Push Notifications & Services',
            'App Deployment & Store Guidelines',
            'CI/CD for Mobile',
          ],
          'Web Development' => [
            'HTML, CSS & JavaScript Basics',
            'Responsive Design & Accessibility',
            'Frontend Frameworks (Vue, React, Angular)',
            'Backend Development (Laravel, Node.js)',
            'Database Design & SQL/NoSQL',
            'Authentication & Authorization',
            'REST & GraphQL APIs',
            'Testing & Debugging',
            'Performance & SEO',
            'Deployment & DevOps Practices',
          ],
           'Cybersecurity' => [
            'Introduction to Networking',
            'Operating Systems Fundamentals',
            'Cybersecurity Basics (CIA Triad)',
            'Network Security',
            'Ethical Hacking & Penetration Testing',
            'Security Operations & Incident Response',
            'Secure Software Development',
            'Cloud Security',
            'Threat Intelligence',
            'Security Governance & Compliance',
          ],
          'Game Development' => [
            'Programming Fundamentals (C#, C++ or JavaScript)',
            'Game Math & Physics Basics',
            'Unity or Unreal Engine Fundamentals',
            '2D & 3D Graphics Pipelines',
            'Animation & Rigging',
            'Gameplay Mechanics & Scripting',
            'Audio Integration',
            'UI & HUD Design',
            'Optimization & Performance Tuning',
            'Publishing & Monetization Strategies',
          ],
          'UI/UX Design' => [
            'Principles of Design (Contrast, Alignment, Repetition, Proximity)',
            'User Research & Personas',
            'Wireframing & Prototyping (Figma, Sketch)',
            'Interaction Design Basics',
            'Visual Design & Typography',
            'Accessibility & Inclusive Design',
            'User Testing & Feedback',
            'Design Systems & Component Libraries',
            'Responsive & Mobile-First Design',
            'Portfolio Building & Case Studies',
          ],
        ];

        return view('student.dashboard', compact(
          'profile', 'complete', 'techFields', 'roadmaps'
        ));
    }
    public function editProfile()
    {
        $user    = Auth::user();
        $profile = $user->profile ?? new StudentProfile();
        return view('student.profile', compact('profile'));
    }


public function updateProfile(Request $request)
{
  $data = $request->validate([
    'full_name'           => 'required|string|max:255',
    'date_of_birth'       => 'required|date',
    'gender'              => 'nullable|in:male,female,other',
    'gpa'                 => 'nullable|numeric|min:0|max:4',
    'senior_high_grade'   => 'nullable|numeric|min:0|max:100',
    'interests'           => 'nullable|array',
    'interests.*'         => 'string',
  ]);

  $user = Auth::user();
   \App\Models\StudentProfile::updateOrCreate(
     ['user_id' => $user->id],
     $data
   );

   // Also update the user's name in the users table
   if (isset($data['full_name'])) {
     $user->name = $data['full_name'];
     $user->save();
   }

   return redirect()->route('dashboard');
}

  public function startQuestionnaire()
    {
        // Use the new simplified questionnaire implementation
        return view('questionnaire.start');
    }
    public function submitQuestionnaire(Request $request, DecisionTreeService $dtree)
    {
        $answers = $request->validate([
            'answers' => 'required|string',
        ]);
        $decoded = json_decode($answers['answers'], true) ?? [];
        $userId = Auth::id();
        try {
            $dtree->predictForUserWithFeatures($userId, array_values($decoded));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('student.results');
    }

    public function results()
    {
        $recommendations = [];
        $universities = [];
        $error = session('error');
        $user = Auth::user();
        
        if (! $error) {
            $recommendations = $user
                ->recommendations()
                ->orderByDesc('score')
                ->with('techField')
                ->get();
            
            // Get university recommendations based on top 3 tech fields
            if ($recommendations->count() > 0) {
                // Get top 3 tech fields with their scores
                $topTechFields = [];
                foreach ($recommendations->take(3) as $recommendation) {
                    $topTechFields[$recommendation->techField->name] = $recommendation->score;
                }
                
                // Get matching universities
                $universities = \App\Models\University::getMatchingUniversities($topTechFields, 5);
            }
        }
        
        // Check if user has completed the survey
        $hasSurvey = $user->surveyResponse()->exists();

        $chartPayload = $this->buildChartPayload($recommendations, (int) $user->id);
        
        return view('student.results', compact('recommendations', 'universities', 'error', 'hasSurvey', 'chartPayload'));
    }

      private function buildChartPayload($recommendations, int $userId): array
      {
        $recommendationCollection = collect($recommendations)->values();

        $barData = $recommendationCollection
          ->take(3)
          ->values()
          ->map(function ($recommendation) {
            return [
              'name' => $recommendation->techField->name,
              'score' => round($recommendation->score * 100),
              'explanation' => $recommendation->techField->description,
            ];
          })
          ->all();

        $donutData = $recommendationCollection
          ->map(function ($recommendation) {
            return [
              'name' => $recommendation->techField->name,
              'score' => round($recommendation->score * 100),
              'explanation' => $recommendation->techField->description,
            ];
          })
          ->all();

        $axisBaseScores = $this->calculateAxisBaseScores($userId);
        $radarAxes = ['Logic', 'Creativity', 'Hardware', 'Security', 'Problem-Solving'];
        $radarAxisExplanations = [
          'Logic' => 'How strongly your answers indicate analytical and structured reasoning.',
          'Creativity' => 'How strongly your answers suggest design, ideation, and creative output.',
          'Hardware' => 'How strongly your answers align with device, systems, and physical computing interests.',
          'Security' => 'How strongly your answers reflect safety, risk awareness, and secure-by-design thinking.',
          'Problem-Solving' => 'How strongly your answers indicate persistence in resolving complex technical challenges.',
        ];

        $topCareerRecommendations = $recommendationCollection->take(3)->values();
        $radarSeries = $topCareerRecommendations
          ->map(function ($recommendation, $index) {
            return [
              'key' => 'career_' . $index,
              'label' => $recommendation->techField->name,
              'score' => round($recommendation->score * 100),
            ];
          })
          ->all();

        $radarData = collect($radarAxes)
          ->map(function ($axis) use ($topCareerRecommendations, $axisBaseScores, $radarAxisExplanations) {
            $row = [
              'axis' => $axis,
              'explanation' => $radarAxisExplanations[$axis],
            ];

            foreach ($topCareerRecommendations as $index => $recommendation) {
              $row['career_' . $index] = $this->calculateCareerAxisScore(
                $axisBaseScores[$axis] ?? 55,
                (float) $recommendation->score,
                $axis,
                $recommendation->techField->name
              );
            }

            return $row;
          })
          ->all();

        return [
          'barData' => $barData,
          'radarData' => $radarData,
          'radarSeries' => $radarSeries,
          'donutData' => $donutData,
          'selectedCareerDetails' => $topCareerRecommendations
            ->map(function ($recommendation) {
              return [
                'name' => $recommendation->techField->name,
                'score' => round($recommendation->score * 100),
                'explanation' => $recommendation->techField->description,
                'details' => [
                  'This match is computed from your completed questionnaire responses and model prediction score.',
                  'Review the radar profile to compare this career against your response-based strengths.',
                ],
              ];
            })
            ->all(),
        ];
      }

      private function calculateAxisBaseScores(int $userId): array
      {
        $defaultAxisScores = [
          'Logic' => 55,
          'Creativity' => 55,
          'Hardware' => 55,
          'Security' => 55,
          'Problem-Solving' => 55,
        ];

        $responses = Response::where('user_id', $userId)
          ->get(['question_id', 'value']);

        if ($responses->isEmpty()) {
          return $defaultAxisScores;
        }

        $axisQuestionMap = [
          'Logic' => [1, 3, 7, 10, 24, 26, 27, 30, 31, 32, 65, 66, 67, 69],
          'Creativity' => [2, 4, 35, 36, 37, 38, 39, 41, 42, 43, 44, 45],
          'Hardware' => [6, 23, 47, 48, 49, 50, 51, 59, 60, 61, 62, 63],
          'Security' => [5, 17, 18, 19, 20, 21, 22, 49, 57],
          'Problem-Solving' => [8, 9, 10, 27, 31, 32, 33, 55, 56, 57, 68, 69],
        ];

        $axisTotals = [
          'Logic' => 0,
          'Creativity' => 0,
          'Hardware' => 0,
          'Security' => 0,
          'Problem-Solving' => 0,
        ];
        $axisCounts = [
          'Logic' => 0,
          'Creativity' => 0,
          'Hardware' => 0,
          'Security' => 0,
          'Problem-Solving' => 0,
        ];

        foreach ($responses as $response) {
          $normalizedValue = $this->normalizeResponseValue($response->value);
          $questionId = (int) $response->question_id;

          foreach ($axisQuestionMap as $axis => $questionIds) {
            if (in_array($questionId, $questionIds, true)) {
              $axisTotals[$axis] += $normalizedValue;
              $axisCounts[$axis]++;
            }
          }
        }

        foreach ($defaultAxisScores as $axis => $defaultValue) {
          if ($axisCounts[$axis] > 0) {
            $defaultAxisScores[$axis] = (int) round($axisTotals[$axis] / $axisCounts[$axis]);
          }
        }

        return $defaultAxisScores;
      }

      private function normalizeResponseValue($rawValue): float
      {
        if (is_array($rawValue)) {
          if (empty($rawValue)) {
            return 55;
          }

          $total = 0;
          foreach ($rawValue as $valuePart) {
            $total += $this->normalizeResponseValue($valuePart);
          }

          return $total / count($rawValue);
        }

        if (is_string($rawValue)) {
          $trimmed = trim($rawValue);
          if ($trimmed === '') {
            return 55;
          }

          if ($trimmed[0] === '[' || $trimmed[0] === '{') {
            $decoded = json_decode($trimmed, true);
            if (json_last_error() === JSON_ERROR_NONE) {
              return $this->normalizeResponseValue($decoded);
            }
          }

          if (is_numeric($trimmed)) {
            $rawValue = (float) $trimmed;
          }
        }

        if (!is_numeric($rawValue)) {
          return 55;
        }

        $value = (float) $rawValue;

        if ($value <= 1) {
          return max(0, min(100, $value * 100));
        }

        if ($value <= 3) {
          return ($value / 3) * 100;
        }

        if ($value <= 5) {
          return ($value / 5) * 100;
        }

        if ($value <= 10) {
          return ($value / 10) * 100;
        }

        return max(0, min(100, $value));
      }

      private function calculateCareerAxisScore(float $axisBaseScore, float $careerScore, string $axis, string $careerName): int
      {
        $careerScorePercent = max(0, min(100, $careerScore * 100));
        $axisWeight = $this->getCareerAxisWeight($careerName, $axis);

        $blended = ($axisBaseScore * 0.65) + (($careerScorePercent * $axisWeight) * 0.35);

        return (int) round(max(20, min(100, $blended)));
      }

      private function getCareerAxisWeight(string $careerName, string $axis): float
      {
        $normalized = strtolower(trim(preg_replace('/\s+/', ' ', $careerName)));

        $profiles = [
          'game development' => [
            'Logic' => 1.05,
            'Creativity' => 1.25,
            'Hardware' => 0.85,
            'Security' => 0.80,
            'Problem-Solving' => 1.10,
          ],
          'internet of things' => [
            'Logic' => 1.00,
            'Creativity' => 0.90,
            'Hardware' => 1.30,
            'Security' => 1.00,
            'Problem-Solving' => 1.10,
          ],
          'internet of things (iot)' => [
            'Logic' => 1.00,
            'Creativity' => 0.90,
            'Hardware' => 1.30,
            'Security' => 1.00,
            'Problem-Solving' => 1.10,
          ],
          'iot' => [
            'Logic' => 1.00,
            'Creativity' => 0.90,
            'Hardware' => 1.30,
            'Security' => 1.00,
            'Problem-Solving' => 1.10,
          ],
          'cybersecurity' => [
            'Logic' => 1.10,
            'Creativity' => 0.80,
            'Hardware' => 0.95,
            'Security' => 1.35,
            'Problem-Solving' => 1.15,
          ],
          'artificial intelligence & ml' => [
            'Logic' => 1.25,
            'Creativity' => 1.00,
            'Hardware' => 0.80,
            'Security' => 0.90,
            'Problem-Solving' => 1.20,
          ],
          'data science' => [
            'Logic' => 1.20,
            'Creativity' => 0.95,
            'Hardware' => 0.80,
            'Security' => 0.90,
            'Problem-Solving' => 1.15,
          ],
          'cloud computing' => [
            'Logic' => 1.10,
            'Creativity' => 0.85,
            'Hardware' => 1.05,
            'Security' => 1.05,
            'Problem-Solving' => 1.15,
          ],
          'software development' => [
            'Logic' => 1.10,
            'Creativity' => 0.95,
            'Hardware' => 0.85,
            'Security' => 0.90,
            'Problem-Solving' => 1.20,
          ],
          'blockchain' => [
            'Logic' => 1.15,
            'Creativity' => 0.90,
            'Hardware' => 0.90,
            'Security' => 1.20,
            'Problem-Solving' => 1.10,
          ],
          'ui/ux design' => [
            'Logic' => 0.90,
            'Creativity' => 1.35,
            'Hardware' => 0.70,
            'Security' => 0.70,
            'Problem-Solving' => 1.00,
          ],
          'web development' => [
            'Logic' => 1.10,
            'Creativity' => 1.00,
            'Hardware' => 0.80,
            'Security' => 0.95,
            'Problem-Solving' => 1.15,
          ],
          'mobile development' => [
            'Logic' => 1.05,
            'Creativity' => 1.05,
            'Hardware' => 0.85,
            'Security' => 0.90,
            'Problem-Solving' => 1.10,
          ],
        ];

        return $profiles[$normalized][$axis] ?? 1.0;
      }

    public function submitSurvey(Request $request)
    {
        $data = $request->validate([
            'satisfaction_rating' => 'required|integer|between:1,5',
            'feedback' => 'nullable|string|max:1000',
            'would_recommend' => 'required|boolean',
            'improvements' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        
        // Create or update survey response (should be create since it's unskippable and only shown once)
        UserSurveyResponse::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return response()->json(['success' => true]);
    }

    public function downloadResults()
    {
        $recommendations = Auth::user()
            ->recommendations()
            ->orderByDesc('score')
            ->with('techField')
            ->get();

        // Generate PDF using dompdf
        try {
            $pdf = \PDF::loadView('student.pdf.results', compact('recommendations'));
            return $pdf->download('recommendations.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'PDF generation failed. Please ensure dompdf is installed: composer require barryvdh/laravel-dompdf');
        }
    }
}
