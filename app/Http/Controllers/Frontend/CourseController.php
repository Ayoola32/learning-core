<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CourseBasicInfoCreateRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.instructor-dashboard.course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('frontend.instructor-dashboard.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseBasicInfoCreateRequest $request)
    {
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnailPath = $this->uploadFile($request->file('thumbnail'), 'uploads/courses-thumbnails');
        }

       // validate the request
        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->seo_description = $request->seo_description;
        $course->thumbnail = $thumbnailPath;
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->demo_video_source;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->description = $request->description;
        $course->instructor_id = Auth::guard('web')->user()->id;
        $course->save();

        // save course id to session
        Session::put('course_id', $course->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Basic Info Updated successfully',
            'redirect' => route('instructor.courses.edit', ['course' => $course->id, 'step' => $request->next_step]),
        ]);
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
    public function edit(Request $request, string $id)
    {
        $course = Course::where('id', $id)->where('instructor_id', Auth::guard('web')->user()->id)->first();
        $courseLevels = CourseLevel::all();
        $courseLanguages = CourseLanguage::all();
        $categories = CourseCategory::where('status', 1)
        ->with(['subCategories' => function ($query) {
            $query->where('status', 1);
        }])->get();
        
        switch ($request->step) {
            case '1':
                // code for step 1
            case '2':
                return view('frontend.instructor-dashboard.course.more-info', compact('course', 'categories', 'courseLevels', 'courseLanguages'));
            default:
                abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
