<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseLevelDataTable;
use App\Http\Controllers\Controller;
use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseLevelDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-level.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-level.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:course_languages'],
        ]);

        $level = new CourseLevel();
        $level->name = $request->name;
        $level->slug = Str::slug($request->name);
        $level->save();
        return redirect()->route('admin.course-level.index')->with('success', 'Course Level created successfully.');

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
    public function edit(string $slug)
    {
        $level = CourseLevel::where('slug', $slug)->firstOrFail();
        return view('admin.course.course-level.edit', compact('level'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:course_levels,name,' . $slug],
        ]);

        $level = CourseLevel::findOrFail($slug);
        $level->name = $request->name;
        $level->slug = Str::slug($request->name);
        $level->save();
        return redirect()->route('admin.course-level.index')->with('success', 'Course Level Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
