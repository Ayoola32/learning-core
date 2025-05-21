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
        Schema::create('course_chapter_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('users');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('course_chapter_id')->constrained('course_chapters')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('file_path')->nullable();
            $table->enum('storage', ['upload', 'youtube', 'vimeo', 'external_link'])->nullable();
            $table->string('volume')->nullable();
            $table->integer('duration')->nullable();
            $table->enum('file_type', ['video', 'audio', 'document'])->nullable();
            $table->boolean('downloadable')->default(0);
            $table->integer('order')->default(0);
            $table->boolean('is_preview')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('lesson_type', ['lesson', 'live']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_chapter_lessons');
    }
};
