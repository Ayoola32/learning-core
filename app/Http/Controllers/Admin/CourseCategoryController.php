<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseCategoryStoreRequest;
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
