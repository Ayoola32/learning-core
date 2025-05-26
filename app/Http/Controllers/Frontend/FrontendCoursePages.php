<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseChapterLesson;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
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

        // Fetch categories and subcategories where status = 1
        $categories = CourseCategory::where('status', 1)
        ->with(['subCategories' => function ($query) {
            $query->where('status', 1);
        }])
        ->get();

        // Fetch course Levels
        $courseLevels = CourseLevel::all();

        // Fetch course languages
        $courseLanguages = CourseLanguage::all();

        return view('frontend.pages.courses.course-index', compact('courses', 'categories', 'courseLevels', 'courseLanguages'));
    }

    public function show(Request $request, $slug )
    {
       $course = Course::where('status', 'active')
       ->where('is_approved', 'approved')
       ->where('slug', $slug)
       ->with(['instructor', 'courseChapters.chapterLessons'])
       ->firstOrFail();
       

       return view('frontend.pages.courses.course-details', compact('course'));
            
    }
}
