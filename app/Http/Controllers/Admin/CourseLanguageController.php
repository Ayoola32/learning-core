<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseLanguageDataTable;
use App\Http\Controllers\Controller;
use App\Models\CourseLanguage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CourseLanguageDataTable $dataTable)
    {
        return $dataTable->render('admin.course.course-language.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:course_languages'],
        ]);

        $language = new CourseLanguage();
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();
        return redirect()->route('admin.course-language.index')->with('success', 'Course Language created successfully.');
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
        $language = CourseLanguage::where('slug', $slug)->firstOrFail();
        return view('admin.course.course-language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:course_languages,name,' . $slug],
        ]);

        $language = CourseLanguage::findOrFail($slug);
        $language->name = $request->name;
        $language->slug = Str::slug($request->name);
        $language->save();
        return redirect()->route('admin.course-language.index')->with('success', 'Course Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = CourseLanguage::findOrFail($id);
        $language->delete();
        
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
