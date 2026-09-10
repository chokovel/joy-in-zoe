<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Create the initial administrator from environment variables.
     *
     * The administrator's credentials are read from the .env file
     * (ADMIN_NAME, ADMIN_EMAIL, ADMIN_PASSWORD) and are never
     * hardcoded in source code. The password is hashed with bcrypt.
     */
    public function run(): void
    {
        $name = env('ADMIN_NAME', 'Joy In Zoe Administrator');
        $email = env('ADMIN_EMAIL', 'admin@joyinzoe.org');
        $password = env('ADMIN_PASSWORD');

        if (blank($password)) {
            $this->command?->warn('ADMIN_PASSWORD is not set in .env. Skipping admin seeding.');

            return;
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => Role::Admin,
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        $this->command?->info("Initial administrator seeded: {$email}");
    }
}
