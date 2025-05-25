<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use App\Mail\CourseStatusNotification;
use App\Models\Course;
use App\Models\CourseFeedbacks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('admin.course.courses.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Change the status of the course.
     */
    public function isApproved(Request $request, string $id)
    {
        $request->validate([
            'is_approved' => 'required|in:pending,approved,rejected',
            'feedback' => 'required_if:is_approved,approved,rejected|string|max:1000',
        ]);

        $course = Course::with('instructor')->findOrFail($id);
        $course->is_approved = $request->is_approved;
        $course->save();

        // Save feedback if provided
        if ($request->filled('feedback')) {
            try {
                $adminId = Auth::guard('admin')->check() ? Auth::guard('admin')->id() : (Auth::check() ? Auth::id() : null);
                CourseFeedbacks::create([
                    'course_id' => $course->id,
                    'instructor_id' => $course->instructor_id,
                    'admin_id' => $adminId,
                    'status' => $request->is_approved,
                    'feedback' => $request->feedback,
                ]);

                // Send email notification to instructor if approved or rejected
            if (in_array($request->is_approved, ['approved', 'rejected']) && $course->instructor && $course->instructor->email) {
                Mail::to($course->instructor->email)->queue(new CourseStatusNotification($course, $request->is_approved, $request->feedback));
            }
            } catch (\Exception $e) {
                \Log::error('Feedback creation or email sending failed: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Failed to save feedback or send email: ' . $e->getMessage()], 500);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Course status updated successfully',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
