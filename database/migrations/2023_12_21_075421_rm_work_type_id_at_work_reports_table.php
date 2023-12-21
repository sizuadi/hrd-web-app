<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('work_reports', function (Blueprint $table) {
            $table->dropColumn("work_type_id");
            $table->date("start_date");
            $table->date("end_date");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_reports', function (Blueprint $table) {
            $table->unsignedBigInteger("work_type_id");
            $table->dropColumn("start_date");
            $table->dropColumn("end_date");
        });
    }
};
