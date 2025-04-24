<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
use App\Http\Requests\Admin\CourseCategoryUpdateRequest;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(CourseCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStoreRequest $request)
    {

        $imagePath = $this->uploadFile($request->file('image'), 'uploads/course-category');

        $category = new CourseCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->status = $request->status;
        $category->show_at_trending = $request->show_at_trending;
        $category->image = $imagePath;

        // Prevent enabling show_at_trending if status is off
        if ($category->status == 0 && $category->show_at_trending == 1) {
            $category->show_at_trending = 0;
            session()->flash('warning', 'Show at Trending was turned off because Status is off');
        }
        $category->save();


        return redirect()->route('admin.course-category.index')->with('success', 'Course Category Created Successfully');
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
        $category = CourseCategory::where('slug', $slug)->firstOrFail();
        return view('admin.course.course-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, string $id)
    {
        $category = CourseCategory::findOrFail($id);

        if ($request->hasFile('image')) {
            $this->deleteFile($category->image);
            $imagePath = $this->uploadFile($request->file('image'), 'uploads/course-category');
            $category->image = $imagePath;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->status = $request->status;
        $category->show_at_trending = $request->show_at_trending;

        // Prevent enabling show_at_trending if status is off
        if ($category->status == 0 && $category->show_at_trending == 1) {
            $category->show_at_trending = 0;
            session()->flash('warning', 'Show at Trending was turned off because Status is off');
        }

        $category->save();
        return redirect()->route('admin.course-category.index')->with('success', 'Course Category Updated Successfully');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, string $id)
    {
        $category = CourseCategory::findOrFail($id);
        $category->status = $request->status;

        // If status is turned off, also turn off show_at_trending
        if ($category->status == 0 && $category->show_at_trending == 1) {
            $category->show_at_trending = 0;
        }

        $category->save();

        return response()->json(['success' => 'Status updated successfully.']);
    }

    /**
     * Update the show_at_trending status of the specified resource.
     */
    public function updateShowAtTrending(Request $request, string $id)
    {
        $category = CourseCategory::findOrFail($id);

        // Prevent enabling show_at_trending if status is off
        if ($request->show_at_trending == 1 && $category->status == 0) {
            return response()->json([
                'error' => 'Cannot enable Show at Trending when Status is off'
            ], 422);
        }
        
        $category->show_at_trending = $request->show_at_trending;
        $category->save();

        return response()->json(['success' => 'Show at trending status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
