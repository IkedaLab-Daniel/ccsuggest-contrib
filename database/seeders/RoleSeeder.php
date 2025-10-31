<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;  // ← Add this import

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'student'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(
                ['name' => $roleName],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
