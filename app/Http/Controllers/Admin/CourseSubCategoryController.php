<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseSubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseSubCategoryStoreRequest;
use App\Models\CourseCategory;
use App\Models\CourseSubCategory;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Str;

class CourseSubCategoryController extends Controller
{
    use FileUpload;
    public function index(CourseCategory $course_category, CourseSubCategoryDataTable $dataTable)
    {
        if (!$course_category) {
            return redirect()->back()->with('error', 'Course category not found.');
        }

        return $dataTable->setCategoryId($course_category->id)
            ->render('admin.course.course-sub-category.index', compact('course_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CourseCategory $course_category)
    {
        return view('admin.course.course-sub-category.create', compact('course_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseSubCategoryStoreRequest $request, CourseCategory $course_category)
    {
        $subCategory = new CourseSubCategory();

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'), 'uploads/course-category');
            $subCategory->image = $imagePath;
        }
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->icon = $request->icon;
        $subCategory->status = $request->status;
        $subCategory->show_at_trending = $request->show_at_trending;
        $subCategory->category_id = $course_category->id;

        // Prevent enabling show_at_trending if status is off
        if ($subCategory->status == 0 && $subCategory->show_at_trending == 1) {
            $subCategory->show_at_trending = 0;
            session()->flash('warning', 'Show at Trending was turned off because Status is off');
        }

        $subCategory->save();
        return redirect()->route('admin.sub-category.index', $course_category->id)->with('success', 'Course Sub Category Created Successfully');
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
