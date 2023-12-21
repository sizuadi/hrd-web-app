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
        Schema::create('work_report_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("work_report_id");
            $table->longText("module");
            $table->unsignedInteger("day");
            $table->unsignedInteger("hour");
            $table->unsignedInteger("total_hour");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_report_details');
    }
};
