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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->string('type');
            $table->string('area');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('background')->nullable();
            $table->text('question')->nullable();
            $table->text('objective')->nullable();
            $table->text('skills')->nullable();

            // Foreign keys
            $table->unsignedBigInteger('user_id'); // Student submitting the proposal
            $table->string('student_id'); // Official overseeing
            $table->string('ass_teacher_id')->nullable(); // Assigned teacher
            $table->unsignedBigInteger('dept_id'); // Department

            // Defining foreign key constraints
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('student_id')->references('official_id')->on('users')->onDelete('cascade'); // Ensure official_id exists in users table
            $table->foreign('ass_teacher_id')->references('official_id')->on('users')->onDelete('cascade'); // Ensure assigned_teacher exists in users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
