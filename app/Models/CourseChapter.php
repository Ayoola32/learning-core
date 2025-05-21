<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseChapter extends Model
{
    use HasFactory;
    public function chapterLessons()
    {
        return $this->hasMany(CourseChapterLesson::class, 'course_chapter_id');
    }
}
