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
        Schema::create('course_lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id')->constrained('course_sections')->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['video', 'article', 'file'])->default('video');
            $table->text('content')->nullable();         // for article/text
            $table->string('video_url')->nullable();     // external link
            $table->string('file_path')->nullable();     // uploaded file

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lessons');
    }
};
