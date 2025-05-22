<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseChapter;
use App\Models\CourseChapterLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseContentController extends Controller
{
    // CREATE CHAPTER
    public function createChapter($course)
    {
        return view('frontend.instructor-dashboard.course.partials.course-chapter-modal', compact('course'))->render();
    }

    // STORE CHAPTER
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

    // EDIT CHAPTER
    public function editChapter($course, $chapter)
    {
        $course = Course::where('id', $course)->where('instructor_id', Auth::guard('web')->user()->id)->firstOrFail();
        $chapter = CourseChapter::where('id', $chapter)->where('course_id', $course->id)->firstOrFail();

        return view('frontend.instructor-dashboard.course.partials.course-chapter-modal-edit', compact('course', 'chapter'))->render();
    }

    // UPDATE CHAPTER
    public function updateChapter(Request $request, $course, $chapter)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $course = Course::where('id', $course)->where('instructor_id', Auth::guard('web')->user()->id)->firstOrFail();
        $chapter = CourseChapter::where('id', $chapter)->where('course_id', $course->id)->firstOrFail();
        $chapter->title = $request->title;
        $chapter->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Chapter "' . $chapter->title . '" updated successfully.',
        ]);
    }

    // DELETE CHAPTER
    public function deleteChapter($course, $chapter)
    {
        // Verify course and chapter
        $course = Course::where('id', $course)->where('instructor_id', Auth::guard('web')->user()->id)->firstOrFail();
        $chapter = CourseChapter::where('id', $chapter)->where('course_id', $course->id)->firstOrFail();

        // Check if the chapter has lessons
        $lessonCount = CourseChapterLesson::where('course_chapter_id', $chapter->id)->count();
        if ($lessonCount > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cannot delete chapter because it contains lessons. Please delete the lessons first.',
            ], 403);
        }

        // Delete the chapter
        $chapter->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Chapter deleted successfully',
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
            'description' => 'nullable|string|max:2000',
            'storage' => 'required|in:upload,youtube,vimeo,external_link',
            'file' => 'required_if:storage,upload|nullable|string|max:255',
            'url' => 'required_if:storage,youtube,vimeo,external_link|nullable|url|max:255',
            'file_type' => 'required|in:video,audio,document',
            'duration' => 'required|integer|min:0',
            'is_preview' => 'nullable|boolean',
            'downloadable' => 'nullable|boolean',
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

        // Create Lesson
        $lesson = new CourseChapterLesson();
        $lesson->instructor_id = Auth::guard('web')->user()->id;
        $lesson->course_id = $course->id;
        $lesson->course_chapter_id = $chapter->id;
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title) . '-' . time(); // Unique slug
        $lesson->description = $request->description;
        $lesson->file_path = $filePath;
        $lesson->storage = $request->storage;
        $lesson->file_type = $request->file_type;
        $lesson->duration = $request->duration ?? 0;
        $lesson->is_preview = $request->is_preview ?? 0;
        $lesson->downloadable = $request->downloadable ?? 0;
        $lesson->volume = $request->volume ?? 0;
        $lesson->lesson_type = 'lesson';
        $lesson->order = CourseChapterLesson::where('course_chapter_id', $chapter->id)->max('order') + 1;
        $lesson->status = $request->status ?? 'active';
        $lesson->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Lesson created successfully',
        ]);
    }

    // EDIT LESSON
    public function editLesson($course, $chapter, $lesson)
    {
        $course = Course::where('id', $course)->where('instructor_id', Auth::guard('web')->user()->id)->firstOrFail();
        $chapter = CourseChapter::where('id', $chapter)->where('course_id', $course->id)->firstOrFail();
        $lesson = CourseChapterLesson::where('id', $lesson)->where('course_chapter_id', $chapter->id)->firstOrFail();

        return view('frontend.instructor-dashboard.course.partials.chapter-lesson-modal-edit', compact('course', 'chapter', 'lesson'))->render();
    }

    // UPDATE LESSON
    public function updateLesson(Request $request, $course, $chapter, $lesson)
    {
        // Validate the request
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'storage' => 'required|in:upload,youtube,vimeo,external_link',
            'file' => 'required_if:storage,upload|nullable|string|max:255',
            'url' => 'required_if:storage,youtube,vimeo,external_link|nullable|url|max:255',
            'file_type' => 'required|in:video,audio,document',
            'duration' => 'required|integer|min:0',
            'is_preview' => 'nullable|boolean',
            'downloadable' => 'nullable|boolean',
        ];
        $request->validate($rules);

        // Verify course, chapter and lesson
        $course = Course::where('id', $course)->where('instructor_id', Auth::guard('web')->user()->id)->firstOrFail();
        $chapter = CourseChapter::where('id', $chapter)->where('course_id', $course->id)->firstOrFail();
        $lesson = CourseChapterLesson::where('id', $lesson)->where('course_chapter_id', $chapter->id)->firstOrFail();

        // Handle file path/source
        if ($request->storage === 'upload' && $request->filled('file')) {
            $lesson->file_path = $request->file; 
        } elseif (in_array($request->storage, ['youtube', 'vimeo', 'external_link']) && $request->filled('url')) {
            $lesson->file_path = $request->url;
        } else {
            $lesson->file_path = null; // Clear if validation fails
        }

        // Update Lesson
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title) . '-' . time();
        $lesson->description = $request->description;
        $lesson->file_type = $request->file_type;
        $lesson->storage = $request->storage;
        $lesson->duration = $request->duration ?? 0;
        $lesson->is_preview = $request->is_preview ?? 0;
        $lesson->downloadable = $request->downloadable ?? 0;
        $lesson->volume = $request->volume ?? 0;
        if ($request->has('status')) {
            $lesson->status = $request->status;
        }
        $lesson->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Lesson updated successfully',
        ]); 
    }
}