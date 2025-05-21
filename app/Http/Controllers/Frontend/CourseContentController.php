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

    // STORE LESSON
    public function storeLesson(Request $request, $course, $chapter)
    {
        // Validate the request
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'storage' => 'required|in:upload,youtube,vimeo,external_link',
            'file' => 'required_if:storage,upload|nullable|string|max:255',
            'url' => 'required_if:storage,youtube,vimeo,external_link|nullable|url|max:255',
            'file_type' => 'required|in:video,audio,document',
        ];
        $request->validate($rules);

        // Verify course and chapter
        $course = Course::where('id', $course)->where('instructor_id', Auth::guard('web')->user()->id)->firstOrFail();
        $chapter = CourseChapter::where('id', $chapter)->where('course_id', $course->id)->firstOrFail();

        // Handle file path/source
        $filePath = null;
        if ($request->storage === 'upload' && $request->filled('file')) {
            $filePath = $request->file; 
        } elseif (in_array($request->storage, ['youtube', 'vimeo', 'external_link']) && $request->filled('url')) {
            $filePath = $request->url;
        } else {
            $filePath = null; // Clear if validation fails
        }

        // Create the lesson (assuming CourseLesson model)
        $lesson = new courseChapterLesson();
        $lesson->instructor_id = Auth::guard('web')->user()->id;
        $lesson->course_id = $course->id;
        $lesson->course_chapter_id = $chapter->id;
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title) . '-' . time(); // Unique slug
        $lesson->description = $request->description;
        $lesson->file_path = $filePath;
        $lesson->storage = $request->storage;
        $lesson->file_type = $request->file_type;
        $lesson->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Lesson created successfully',
            'redirect' => route('instructor.courses.edit', ['course' => $course->id, 'step' => 3]),
        ]);
    }
}