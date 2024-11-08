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
        Schema::table('users', function (Blueprint $table) {
            $table->string('official_id')->unique();
            $table->string('teacher_initial')->nullable();
            $table->string('assigned_teacher')->nullable(); // Add nullable profile picture column
            $table->string('designation')->nullable();
            $table->string('role'); // 'role' column
            $table->string('status')->default('pending'); 
            $table->boolean('isAdmin')->default(false); // 'isAdmin' boolean column
            $table->boolean('isSuperAdmin')->default(false); // 'isSuperAdmin' boolean column
            
            $table->unsignedBigInteger('dept_id')->nullable(); // 'dept_id' foreign key column

            // Defining foreign key constraint for 'dept_id'
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');

            $table->string('credit_finished')->nullable();
            $table->string('cgpa')->nullable();
            $table->integer('batch')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('official_id');
            $table->dropColumn('teacher_initial');
            $table->dropColumn('assigned_teacher');
            $table->dropColumn('designation');
            $table->dropColumn('role');
            $table->dropColumn('status');
            $table->dropColumn('status');
            $table->dropColumn('isAdmin');
            $table->dropColumn('isSuperAdmin');

            $table->dropForeign(['dept_id']);
            $table->dropColumn('dept_id');

            $table->dropColumn('credit_finished');
            $table->dropColumn('cgpa');
            $table->dropColumn('batch');
        });
    }
};
