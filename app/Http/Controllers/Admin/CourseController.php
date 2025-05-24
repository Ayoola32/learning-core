<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

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
        ]);

        $course = Course::findOrFail($id);
        $course->is_approved = $request->is_approved;
        $course->save();

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
