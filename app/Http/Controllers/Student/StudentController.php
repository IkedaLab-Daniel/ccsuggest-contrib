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
        
        return view('student.results', compact('recommendations', 'universities', 'error', 'hasSurvey'));
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
