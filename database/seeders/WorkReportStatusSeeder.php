<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ["id" => 0, "name" => "Cancelled"],
            ["id" => 1, "name" => "Input"],
            ["id" => 2, "name" => "Confirm"],
        ];
        foreach ($statuses as $status) {
            DB::table("work_report_statuses")->updateOrInsert($status);
        }
    }
}
