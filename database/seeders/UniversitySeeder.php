<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\University;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $universities = [
            [
                'name' => 'Central Luzon State University (CLSU)',
                'type' => 'public',
                'location' => 'Nueva Ecija',
                'programs' => 'BSIT (Software Systems & Web Apps Eng, Network Systems & Infra Eng), BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct (BSIT Software Systems, BSCS)',
                    'Cybersecurity' => 'Partial/Direct (Network Systems covers security topics)',
                    'Cloud Computing' => 'Partial (infra/network electives)',
                    'Data Science & Analytics' => 'Partial (CS/IT electives, research)',
                    'Artificial Intelligence' => 'Partial (electives/research)',
                    'UI/UX' => 'Partial (web apps)',
                    'IoT' => 'Partial (research/electives)'
                ]
            ],
            [
                'name' => 'Tarlac State University (TSU)',
                'type' => 'public',
                'location' => 'Tarlac',
                'programs' => 'BSIT (Network Admin, Technical Service Management, Web & Mobile Apps), BSIS, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct (BSIT WMA, BSCS)',
                    'Cybersecurity' => 'Direct/Partial (BSIT — Network Admin)',
                    'Cloud Computing' => 'Partial (TSM topics)',
                    'Data Science & Analytics' => 'Partial/Direct (BSIS / BSCS subjects)',
                    'UI/UX' => 'Partial (Web & Mobile subjects)'
                ]
            ],
            [
                'name' => 'Bulacan State University (BulSU)',
                'type' => 'public',
                'location' => 'Bulacan',
                'programs' => 'BSIT, BSCS, BS Math (major in CS)',
                'tech_fields' => [
                    'Software Development' => 'Direct (BSIT/BSCS)',
                    'Data Science & Analytics' => 'Direct/Partial (BS Math (CS), CS electives)',
                    'Cybersecurity' => 'Partial (networking/security subjects)',
                    'Artificial Intelligence' => 'Partial (elective/research)'
                ]
            ],
            [
                'name' => 'Nueva Ecija University of Science & Technology (NEUST)',
                'type' => 'public',
                'location' => 'Nueva Ecija',
                'programs' => 'BSIT (Database, Network, Web Systems), BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct (BSIT/BSCS)',
                    'Cybersecurity' => 'Partial (Network Systems topics)',
                    'Data Science & Analytics' => 'Partial (database/analytics subjects)'
                ]
            ],
            [
                'name' => 'Bataan Peninsula State University (BPSU)',
                'type' => 'public',
                'location' => 'Bataan',
                'programs' => 'BSIT, BSCS (multiple campuses; some EMC/multimedia)',
                'tech_fields' => [
                    'Software Development' => 'Direct (BSIT/BSCS)',
                    'Game Development' => 'Partial (EMC at some campuses)',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Don Honorio Ventura Technological State University (DHVTSU)',
                'type' => 'public',
                'location' => 'Pampanga',
                'programs' => 'BSIT, BSCS, BSIS',
                'tech_fields' => [
                    'Software Development' => 'Direct (BSIT/BSCS/BSIS)',
                    'Cybersecurity' => 'Partial (networking topics)',
                    'Data Science & Analytics' => 'Partial (IS/CS subjects)'
                ]
            ],
            [
                'name' => 'Pampanga State Agricultural University (PSAU)',
                'type' => 'public',
                'location' => 'Pampanga',
                'programs' => 'BSIT/BSCS (campus dependent)',
                'tech_fields' => [
                    'Software Development' => 'Direct (BSIT/BSCS where offered)',
                    'Data Science & Analytics' => 'Partial (agri-data application)',
                    'IoT' => 'Partial (agri-IoT projects)',
                    'Robotics' => 'Partial (agri-automation potential)'
                ]
            ],
            [
                'name' => 'Aurora State College of Technology (ASCOT)',
                'type' => 'public',
                'location' => 'Aurora',
                'programs' => 'BSIT, BSCS (STEM/tech programs)',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial',
                    'IoT' => 'Partial',
                    'Robotics' => 'Partial'
                ]
            ],
            [
                'name' => 'Polytechnic University of the Philippines (PUP) — Pulilan',
                'type' => 'public',
                'location' => 'Bulacan',
                'programs' => 'BSIT, BSCS, Computer Engineering (PUP system)',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Cybersecurity' => 'Partial',
                    'Data Science & Analytics' => 'Partial',
                    'IoT' => 'Partial'
                ]
            ],
            [
                'name' => 'Holy Angel University (HAU)',
                'type' => 'private',
                'location' => 'Angeles City',
                'programs' => 'BSCS, BSIT, BS Cybersecurity, Entertainment & Multimedia Computing (EMC)',
                'tech_fields' => [
                    'Cybersecurity' => 'Direct (BS Cybersecurity)',
                    'Software Development' => 'Direct (BSCS/BSIT)',
                    'Game Development' => 'Direct/Partial (EMC — Game/Animation track)',
                    'UI/UX' => 'Direct/Partial (EMC / multimedia)',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Angeles University Foundation (AUF)',
                'type' => 'private',
                'location' => 'Angeles City',
                'programs' => 'BSCS (Data Science track), BSIT, BMMA (multimedia / UI/UX)',
                'tech_fields' => [
                    'Data Science & Analytics' => 'Direct (BSCS data track)',
                    'Software Development' => 'Direct',
                    'UI/UX' => 'Direct (BMMA)',
                    'Artificial Intelligence' => 'Partial',
                    'Robotics' => 'Partial'
                ]
            ],
            [
                'name' => 'AMA Computer University (Region III)',
                'type' => 'private',
                'location' => 'Region III campuses',
                'programs' => 'BSIT, BSCS, BSIS; professional certificates in AI, Cybersecurity, Cloud, Data Science',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Cybersecurity' => 'Direct/Certs',
                    'Cloud Computing' => 'Direct/Certs',
                    'Data Science & Analytics' => 'Direct/Certs',
                    'Artificial Intelligence' => 'Direct/Certs',
                    'Game Development' => 'Partial (electives / certs)',
                    'UI/UX' => 'Partial (electives / certs)',
                    'IoT' => 'Partial (electives / certs)',
                    'Blockchain' => 'Partial (electives / certs)',
                    'Robotics' => 'Partial (electives / certs)'
                ]
            ],
            [
                'name' => 'Our Lady of Fatima University (OLFU) — Pampanga',
                'type' => 'private',
                'location' => 'Pampanga',
                'programs' => 'BSCS, BSIT',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial',
                    'Cybersecurity' => 'Partial'
                ]
            ],
            [
                'name' => 'Centro Escolar University — Malolos (CEU-Malolos)',
                'type' => 'private',
                'location' => 'Malolos, Bulacan',
                'programs' => 'BSCS, BSIT',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Cloud Computing' => 'Partial',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'La Consolacion University Philippines (LCUP) — Baliwag',
                'type' => 'private',
                'location' => 'Baliwag, Bulacan',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Baliuag University',
                'type' => 'private',
                'location' => 'Baliwag, Bulacan',
                'programs' => 'BSIT, BSIS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial (BSIS)'
                ]
            ],
            [
                'name' => 'Araullo University (AU)',
                'type' => 'private',
                'location' => 'Cabanatuan',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Wesleyan University — Philippines (WU-P)',
                'type' => 'private',
                'location' => 'Cabanatuan',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Lyceum of Subic Bay',
                'type' => 'private',
                'location' => 'Subic Bay',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Game Development' => 'Partial',
                    'UI/UX' => 'Partial',
                    'IoT' => 'Partial',
                    'Robotics' => 'Partial'
                ]
            ],
            [
                'name' => 'University of the Assumption (UA)',
                'type' => 'private',
                'location' => 'Pampanga',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Guagua National Colleges (GNC)',
                'type' => 'private',
                'location' => 'Guagua, Pampanga',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'First City Providential College (FCPC)',
                'type' => 'private',
                'location' => 'San Jose del Monte',
                'programs' => 'BSIT / BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Meycauayan College',
                'type' => 'private',
                'location' => 'Meycauayan, Bulacan',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Maritime Academy of Asia & the Pacific (MAAP)',
                'type' => 'private',
                'location' => 'Mariveles/Bataan',
                'programs' => 'Maritime + technical IT programs',
                'tech_fields' => [
                    'Software Development' => 'Partial (maritime IT systems)',
                    'IoT' => 'Partial (maritime sensors)',
                    'Robotics' => 'Partial (marine robotics potential)',
                    'Cybersecurity' => 'Partial (maritime systems security)'
                ]
            ],
            [
                'name' => 'Colegio de San Gabriel Arcangel',
                'type' => 'private',
                'location' => 'Local HEI',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Columban College',
                'type' => 'private',
                'location' => 'Olongapo',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Dr. Yanga\'s Colleges',
                'type' => 'private',
                'location' => 'Bocaue, Bulacan',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'MV Gallego Foundation Colleges',
                'type' => 'private',
                'location' => 'Local HEI',
                'programs' => 'BSIT/BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Union Christian College',
                'type' => 'private',
                'location' => 'Local HEI',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ],
            [
                'name' => 'Lyceum-Northwestern University',
                'type' => 'private',
                'location' => 'Region III campus',
                'programs' => 'BSIT, BSCS',
                'tech_fields' => [
                    'Software Development' => 'Direct',
                    'Data Science & Analytics' => 'Partial'
                ]
            ]
        ];

        foreach ($universities as $university) {
            University::create($university);
        }
    }
}
