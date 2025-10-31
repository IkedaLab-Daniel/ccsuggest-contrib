<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch role IDs
        $adminRole   = Role::where('name', 'admin')->first();
        $studentRole = Role::where('name', 'student')->first();

        // 1 Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        // 5 Students
        for ($i = 1; $i <= 5; $i++) {
            $student = User::firstOrCreate(
                ['email' => "student{$i}@example.com"],
                [
                    'name'     => "Student {$i}",
                    'password' => Hash::make('password'),
                ]
            );
            $student->roles()->syncWithoutDetaching([$studentRole->id]);
        }
    }
}
