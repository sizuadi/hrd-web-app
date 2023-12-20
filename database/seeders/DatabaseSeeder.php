<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserStatusSeeder::class,
            CompanyStatusSeeder::class,
            RolesAndPermissionsSeeder::class,
            WorkTypeStatusSeeder::class,
            ProjectStatusSeeder::class,
            UserProjectStatusSeeder::class,
            ArchiveInStatusSeeder::class,
            ArchiveOutStatusSeeder::class,
            LoginAdminSeeder::class,
        ]);
    }
}
