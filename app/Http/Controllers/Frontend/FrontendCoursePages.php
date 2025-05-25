<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapterLesson;
use Illuminate\Http\Request;

class FrontendCoursePages extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'active')
            ->where('is_approved', 'approved')
            ->with(['instructor', 'courseChapters.chapterLessons']) // Eager load instructor and course chapters with lessons
            ->latest()
            ->paginate(9);

        return view('frontend.pages.courses.course-index', compact('courses'));
    }
}
