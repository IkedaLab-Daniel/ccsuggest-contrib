<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [

            // 1. Artificial Intelligence
            1 => [
                [
                    'text'    => 'I enjoy designing systems that can make decisions on their own.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which AI application excites you most?',
                    'type'    => 'single',
                    'options' => [
                        'Autonomous vehicles',
                        'Natural language chatbots',
                        'Image recognition for healthcare',
                        'Intelligent game NPCs',
                    ],
                ],
                [
                    'text'    => 'You have raw sensor data from a factory. What’s your first step?',
                    'type'    => 'single',
                    'options' => [
                        'Write rules to flag anomalies',
                        'Cluster the data to find patterns',
                        'Train a model to predict failures',
                        'Visualize trends for human review',
                    ],
                ],
                [
                    'text'    => 'Rate your comfort with linear algebra and probability.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Do you enjoy exploring philosophical questions about machine intelligence and ethics?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'In five years, would you rather be researching new AI algorithms or building AI products in industry?',
                    'type'    => 'single',
                    'options' => [
                        'Researching new AI algorithms',
                        'Building AI products in industry',
                    ],
                ],
            ],

            // 2. Machine Learning
            2 => [
                [
                    'text'    => 'I like experimenting with different models to improve prediction accuracy.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which dataset challenge appeals to you?',
                    'type'    => 'single',
                    'options' => [
                        'Extremely large-scale data (Big Data pipelines)',
                        'Noisy, real-world data cleaning',
                        'Time-series forecasting',
                        'Imbalanced classification problems',
                    ],
                ],
                [
                    'text'    => 'Your model is overfitting. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Collect more training data',
                        'Simplify the model (fewer features)',
                        'Add regularization',
                        'Use an ensemble method',
                    ],
                ],
                [
                    'text'    => 'How confident are you writing preprocessing pipelines (scaling, encoding, feature selection)?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'How much do you enjoy hyperparameter tuning and model benchmarking?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Would you prefer to be a data scientist prototyping models or a machine learning engineer productionizing models?',
                    'type'    => 'single',
                    'options' => [
                        'Data scientist prototyping models',
                        'Machine learning engineer productionizing models',
                    ],
                ],
            ],

            // 3. Cybersecurity
            3 => [
                [
                    'text'    => 'Protecting systems from attack excites me more than building new features.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which security domain interests you most?',
                    'type'    => 'single',
                    'options' => [
                        'Network penetration testing',
                        'Secure software development (DevSecOps)',
                        'Forensics and incident response',
                        'Cryptography and encryption',
                    ],
                ],
                [
                    'text'    => 'You discover unusual traffic in your network. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Block the source IP immediately',
                        'Capture traffic and analyze patterns',
                        'Patch vulnerable services first',
                        'Notify stakeholders and isolate the segment',
                    ],
                ],
                [
                    'text'    => 'Have you ever taken part in a Capture The Flag (CTF) hacking competition?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'Rate your familiarity with Linux internals and command-line tools.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Do you see yourself as a red-team ethical hacker or a blue-team security analyst?',
                    'type'    => 'single',
                    'options' => [
                        'Red-team ethical hacker',
                        'Blue-team security analyst',
                    ],
                ],
            ],

            // 4. Software Development
            4 => [
                [
                    'text'    => 'I enjoy architecting and writing modular, reusable code.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'What part of building an app do you find most satisfying?',
                    'type'    => 'single',
                    'options' => [
                        'Designing the data models and APIs',
                        'Crafting intuitive user interactions',
                        'Optimizing performance and resource use',
                        'Integrating third-party services',
                    ],
                ],
                [
                    'text'    => 'Your build fails in production. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Write a failing test case and fix the code',
                        'Roll back and analyze logs',
                        'Automate deployment scripts to prevent recurrence',
                        'Notify stakeholders and patch urgently',
                    ],
                ],
                [
                    'text'    => 'How comfortable are you debugging complex, multi-layered systems?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you ever contributed to an open-source project?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'Would you rather build client-facing features in a startup or design backend services at an enterprise?',
                    'type'    => 'single',
                    'options' => [
                        'Client-facing features at a startup',
                        'Backend services at an enterprise',
                    ],
                ],
            ],

            // 5. Data Science & Analytics
            5 => [
                [
                    'text'    => 'I find joy in uncovering patterns hidden within raw data.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which analytics task would you pick?',
                    'type'    => 'single',
                    'options' => [
                        'Exploratory data analysis and visualization',
                        'Statistical hypothesis testing',
                        'Building dashboards for stakeholders',
                        'Developing ETL pipelines',
                    ],
                ],
                [
                    'text'    => 'Your dataset has missing values. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Impute with mean/median',
                        'Drop the incomplete rows',
                        'Use a model-based imputation',
                        'Treat “missing” as its own category',
                    ],
                ],
                [
                    'text'    => 'Rate your proficiency with SQL and database querying.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you built a visualization using libraries like Matplotlib, D3, or Tableau?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'Would you prefer to work as a data analyst translating insights or a data scientist building predictive models?',
                    'type'    => 'single',
                    'options' => [
                        'Data analyst translating insights',
                        'Data scientist building predictive models',
                    ],
                ],
            ],

            // 6. UI/UX Design
            6 => [
                [
                    'text'    => 'I enjoy creating user journeys that feel intuitive and engaging.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which design activity do you find most appealing?',
                    'type'    => 'single',
                    'options' => [
                        'Wireframing user flows',
                        'Crafting high-fidelity visual mockups',
                        'Conducting usability testing',
                        'Defining interaction animations',
                    ],
                ],
                [
                    'text'    => 'Users report confusion on your page. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Run A/B tests on alternate layouts',
                        'Interview users for direct feedback',
                        'Simplify navigation labels and icons',
                        'Add inline help tooltips',
                    ],
                ],
                [
                    'text'    => 'How comfortable are you using design tools like Figma or Sketch?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you created a clickable prototype for user testing?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'Would you rather lead UX research or head visual design?',
                    'type'    => 'single',
                    'options' => [
                        'Lead UX research',
                        'Head visual design',
                    ],
                ],
            ],

            // 7. Cloud Computing
            7 => [
                [
                    'text'    => 'I enjoy architecting and managing scalable, distributed systems in the cloud.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which cloud service model appeals to you most?',
                    'type'    => 'single',
                    'options' => ['IaaS','PaaS','SaaS','Serverless Functions'],
                ],
                [
                    'text'    => 'Your application performance is degrading under load. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Auto-scale additional instances dynamically',
                        'Implement CDN caching for static assets',
                        'Optimize database queries and connections',
                        'Introduce message queues to smooth traffic spikes',
                    ],
                ],
                [
                    'text'    => 'How comfortable are you writing Infrastructure as Code (e.g., Terraform, CloudFormation)?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you deployed a containerized application using Docker or Kubernetes?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'Would you rather focus on cloud architecture or DevOps CI/CD?',
                    'type'    => 'single',
                    'options' => ['Cloud architecture','DevOps CI/CD'],
                ],
            ],

            // 8. Game Development
            8 => [
                [
                    'text'    => 'I find satisfaction in creating interactive, real-time user experiences.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which aspect of game creation excites you most?',
                    'type'    => 'single',
                    'options' => [
                        'Designing game mechanics and rules',
                        'Implementing 2D/3D graphics and shaders',
                        'Writing physics and collision systems',
                        'Integrating audio and sound effects',
                    ],
                ],
                [
                    'text'    => 'Your character movement feels “slippery.” You would:',
                    'type'    => 'single',
                    'options' => [
                        'Tweak physics parameters for friction and mass',
                        'Smooth input handling with interpolation',
                        'Rewrite the control script for more rigid constraints',
                        'Add inverse kinematics for natural motion',
                    ],
                ],
                [
                    'text'    => 'How confident are you with a game engine (e.g., Unity, Unreal) editor?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you ever published a playable demo or prototype of a game?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'In your ideal role, would you be a gameplay programmer or a technical artist?',
                    'type'    => 'single',
                    'options' => ['Gameplay programmer','Technical artist'],
                ],
            ],

            // 9. Internet of Things
            9 => [
                [
                    'text'    => 'I enjoy building systems that connect physical devices to the internet.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which IoT domain interests you most?',
                    'type'    => 'single',
                    'options' => [
                        'Smart home automation',
                        'Industrial sensor networks',
                        'Wearable health monitors',
                        'Connected vehicles',
                    ],
                ],
                [
                    'text'    => 'A remote sensor loses connectivity. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Buffer readings locally and retry periodically',
                        'Switch to a backup communication protocol',
                        'Send an alert to a monitoring dashboard',
                        'Reboot the device remotely',
                    ],
                ],
                [
                    'text'    => 'How comfortable are you programming embedded microcontrollers (e.g., Arduino, ESP32)?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you ever worked with MQTT or another IoT messaging protocol?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'Would you prefer designing low-power embedded hardware or developing cloud-based analytics for IoT data?',
                    'type'    => 'single',
                    'options' => [
                        'Designing hardware',
                        'Developing cloud analytics',
                    ],
                ],
            ],

            // 10. Robotics & Automation
            10 => [
                [
                    'text'    => 'I enjoy designing mechanical systems that can operate autonomously.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which robotics domain appeals to you most?',
                    'type'    => 'single',
                    'options' => [
                        'Industrial assembly line robots',
                        'Autonomous drones and UAVs',
                        'Service robots (e.g., health, hospitality)',
                        'Humanoid/social robots',
                    ],
                ],
                [
                    'text'    => 'Your robot’s arm misses its target repeatedly. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Calibrate the joint servos and recalibrate encoders',
                        'Refine the motion-planning algorithm',
                        'Add sensors for better feedback (e.g., vision)',
                        'Simplify the mechanical linkage design',
                    ],
                ],
                [
                    'text'    => 'How comfortable are you programming real-time control loops?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you ever built or prototyped an embedded robotics project?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'In your next role, would you rather develop control software for autonomous machines or design and test robotic hardware?',
                    'type'    => 'single',
                    'options' => [
                        'Develop control software',
                        'Design and test hardware',
                    ],
                ],
            ],

            // 11. Blockchain Technology
            11 => [
                [
                    'text'    => 'I’m fascinated by decentralized systems and peer-to-peer protocols.',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Which blockchain use-case excites you most?',
                    'type'    => 'single',
                    'options' => [
                        'Cryptocurrency and digital payments',
                        'Smart contracts for decentralized applications',
                        'Supply-chain provenance tracking',
                        'Decentralized identity and authentication',
                    ],
                ],
                [
                    'text'    => 'You discover a vulnerability in a smart contract. You would:',
                    'type'    => 'single',
                    'options' => [
                        'Write and deploy a patch immediately',
                        'Alert the community and freeze the contract',
                        'Audit all related contracts for similar issues',
                        'Roll back to a previous safe version',
                    ],
                ],
                [
                    'text'    => 'How proficient are you with cryptographic concepts like hashing and digital signatures?',
                    'type'    => 'scale',
                    'options' => [],
                ],
                [
                    'text'    => 'Have you ever written or audited Solidity (or similar) smart-contract code?',
                    'type'    => 'single',
                    'options' => ['Yes','No'],
                ],
                [
                    'text'    => 'Would you prefer architecting scalable blockchain networks or developing end-user decentralized applications?',
                    'type'    => 'single',
                    'options' => [
                        'Architect scalable networks',
                        'Develop decentralized applications',
                    ],
                ],
            ],

        ];

        foreach ($fields as $fieldId => $questions) {
            foreach ($questions as $q) {
                $questionId = DB::table('questions')->insertGetId([
                    'text'         => $q['text'],
                    'type'         => $q['type'],
                    'tech_field_id'=> $fieldId,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                foreach ($q['options'] as $idx => $optText) {
                    DB::table('question_options')->insert([
                        'question_id' => $questionId,
                        'text'        => $optText,
                        'value'       => $idx,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
            }
        }
    }
}
