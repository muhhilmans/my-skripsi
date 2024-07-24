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
        Schema::create('task_evaluations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('task_student_id');
            $table->foreign('task_student_id')->references('id')->on('task_students')->onDelete('cascade');
            $table->integer('score');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_evaluations');
    }
};
