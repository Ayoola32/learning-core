<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseChapterLesson extends Model
{
    //
    public function courseChapter()
    {
        return $this->belongsTo(CourseChapter::class, 'course_chapter_id');
    }
}
