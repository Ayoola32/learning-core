<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapter;
use App\Models\courseChapterLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseContentController extends Controller
{
    // createChapter
    public function createChapter($course)
    {
        return view('frontend.instructor-dashboard.course.partials.course-chapter-modal', compact('course'))->render();
    }

    // storeChapter
    public function storeChapter(Request $request, $course)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Create the chapter
        $chapter = new CourseChapter();
        $chapter->title = $request->title;
        $chapter->course_id = $course;
        $chapter->instructor_id = Auth::guard('web')->user()->id;
        $chapter->order = CourseChapter::where('course_id', $course)->max('order') + 1;
        $chapter->status = 1;
        $chapter->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Chapter "' . $chapter->title . '" created successfully.',
        ]);
    }

    // CREATE LESSON
    public function createLesson($course, $chapter)
    {
        $course = Course::where('id', $course)->where('instructor_id', Auth::guard('web')->user()->id)->firstOrFail();
        $chapter = CourseChapter::where('id', $chapter)->where('course_id', $course->id)->firstOrFail();

        return view('frontend.instructor-dashboard.course.partials.chapter-lesson-modal', compact('course', 'chapter'))->render();
    }
}