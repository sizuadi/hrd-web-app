<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ["id" => 0, "name" => "Input"],
            ["id" => 1, "name" => "Confirm"],
            ["id" => 2, "name" => "Cancelled"],
        ];
        foreach ($statuses as $status) {
            DB::table("user_project_statuses")->updateOrInsert($status);
        }
    }
}
