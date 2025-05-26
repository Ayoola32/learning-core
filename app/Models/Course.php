<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model

{
    use HasFactory;

    function instructor()
    {
       return $this->hasOne(User::class, 'id', 'instructor_id');
    }

    public function courseChapters()
    {
        return $this->hasMany(CourseChapter::class);
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function courseLevel()
    {
        return $this->belongsTo(CourseLevel::class, 'course_level_id');
    }

    public function courseLanguage()
    {
        return $this->belongsTo(CourseLanguage::class, 'course_language_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(CourseFeedbacks::class);
    }

}
