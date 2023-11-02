<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'full_name' => Str::random(10),
                'email' => 'admin@atomic.id',
                'username' => 'admin',
                'rate_per_hour' => 0,
                'password' => Hash::make('password'),
            ]
        );
    }
}
