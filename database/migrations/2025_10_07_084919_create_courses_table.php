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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('learning_outcomes')->nullable();
            $table->longText('requirements')->nullable();
            $table->string('level')->nullable();            // e.g. beginner/intermediate/advanced
            $table->string('audio_language')->nullable();
            $table->string('thumbnail')->nullable();        // e.g. storage/uploads/courses/xxx.jpg
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
