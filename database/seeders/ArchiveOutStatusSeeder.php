<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArchiveOutStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ["id" => 0, "name" => "Inactive"],
            ["id" => 1, "name" => "Active"],
        ];
        foreach ($statuses as $status) {
            DB::table("archive_out_statuses")->updateOrInsert($status);
        }
    }
}
