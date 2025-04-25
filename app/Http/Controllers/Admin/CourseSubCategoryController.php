<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseSubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseSubCategoryStoreRequest;
use App\Http\Requests\Admin\CourseSubCategoryUpdateRequest;
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
    public function edit(CourseCategory $course_category, CourseSubCategory $subCategory)
    {
        return view('admin.course.course-sub-category.edit', compact('subCategory', 'course_category'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseSubCategoryUpdateRequest $request, CourseCategory $course_category, CourseSubCategory $subCategory)
    {
        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'), 'uploads/course-category');
            $subCategory->image = $imagePath;
        }
    
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->icon = $request->icon;
        $subCategory->status = $request->status;
        $subCategory->show_at_trending = $request->show_at_trending;
    
        // Prevent enabling show_at_trending if status is off
        if ($subCategory->status == 0 && $subCategory->show_at_trending == 1) {
            $subCategory->show_at_trending = 0;
            session()->flash('warning', 'Show at Trending was turned off because Status is off');
        }
    
        $subCategory->save();
    
        return redirect()->route('admin.sub-category.index', $course_category->id)->with('success', 'Course Sub Category Updated Successfully');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, CourseCategory $course_category, CourseSubCategory $sub_category)
    {
        $sub_category->status = $request->status;

        // If status is turned off, also turn off show_at_trending
        if ($sub_category->status == 0 && $sub_category->show_at_trending == 1) {
            $sub_category->show_at_trending = 0;
        }
        $sub_category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully.'
        ]);
    }

    /**
     * Update the show_at_trending status of the specified resource.
     */
    public function updateShowAtTrending(Request $request, CourseCategory $course_category, CourseSubCategory $sub_category)
    {
        $sub_category->show_at_trending = $request->show_at_trending;

        // Prevent enabling show_at_trending if status is off
        if ($request->show_at_trending == 1 && $sub_category->status == 0) {
            return response()->json([
                'error' => 'Cannot enable Show at Trending when Status is off'
            ], 422);
        }
        
        $sub_category->save();

        return response()->json(['success' => 'Show at trending status updated successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $course_category, CourseSubCategory $sub_category)
    {
        // Check if the image exists before attempting to delete it
        if ($sub_category->image) {
            $this->deleteFile($sub_category->image);
        }

        $sub_category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory deleted successfully.'
        ]);
    }
}
