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
        Schema::create('archive_ins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("archive_category_id");
            $table->date("date");
            $table->string("archive_number");
            $table->string("source");
            $table->string("subject");
            $table->longText("archive_file");
            $table->longText("description");
            $table->integer("status_id")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_ins');
    }
};
