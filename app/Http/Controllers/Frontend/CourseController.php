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
        $courses = Course::where('instructor_id', Auth::guard('web')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.instructor-dashboard.course.index', compact('courses'));
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
                $course = Course::where('id', $id)->where('instructor_id', Auth::guard('web')->user()->id)->first();
                return view('frontend.instructor-dashboard.course.edit', compact('course'));
            case '2':
                return view('frontend.instructor-dashboard.course.more-info', compact('course', 'categories', 'courseLevels', 'courseLanguages'));
            case '3':
                return view('frontend.instructor-dashboard.course.course-content', compact('course'));
            default:
                abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        switch ($request->current_step) {
            case '1':
                    // Validate the request
                    $rules = [
                        'title' => ['required','string', 'max:255'],
                        'seo_description' => ['nullable', 'string', 'max:255'],
                        'demo_video_storage' => ['nullable', 'string', 'in:upload,vimeo,youtube,external_link'],
                        'demo_video_source' => ['nullable', 'string', 'max:255'],
                        'file' => ['required_if:demo_video_storage,upload', 'nullable', 'string', 'max:255'],
                        'url' => ['required_if:demo_video_storage,youtube,vimeo,external_link', 'nullable', 'string', 'max:255'],
                        'price' => ['required', 'numeric', 'min:0'],
                        'discount_price' => ['nullable', 'numeric', 'min:0'],
                        'description' => ['required', 'string'],
                        'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                    ];
                    $request->validate($rules);


                    $thumbnailPath = null;
                    $course = Course::findOrFail($id);

                    if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                        $this->deleteFile($course->thumbnail);
                        $thumbnailPath = $this->uploadFile($request->file('thumbnail'), 'uploads/courses-thumbnails');
                        $course->thumbnail = $thumbnailPath;
                    }

                    // Handle demo video storage and source
                    $demoVideoStorage = $request->demo_video_storage;
                    $demoVideoSource = null;

                    if ($demoVideoStorage) {
                        if ($demoVideoStorage == 'upload' && $request->filled('file')) {
                            $demoVideoSource = $request->file;
                        } elseif (in_array($demoVideoStorage, ['youtube', 'vimeo', 'external_link']) && $request->filled('url')) {
                            $demoVideoSource = $request->url;
                        } else {
                            // If the corresponding field is missing, clear both
                            $demoVideoStorage = null;
                            $demoVideoSource = null;
                        }
                    }

            
                    // validate the request
                    $course->title = $request->title;
                    $course->slug = Str::slug($request->title);
                    $course->seo_description = $request->seo_description;
                    $course->demo_video_storage = $demoVideoStorage;
                    $course->demo_video_source = $demoVideoSource;
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
                break;
            case '2':
                // Validate the request
                $request->validate([
                    'capacity' => 'nullable|integer|min:1',
                    'duration' => 'required|integer|min:1',
                    'qna' => 'nullable|boolean',
                    'certificate' => 'nullable|boolean',
                    'category' => 'required|exists:course_sub_categories,id',
                    'level' => 'required|exists:course_levels,id',
                    'language' => 'required|exists:course_languages,id',
                ]);

                $course = Course::findOrFail($id);
                $course->capacity = $request->capacity ? (int) $request->capacity : null; 
                $course->duration = (int) $request->duration;
                $course->qna = $request->has('qna') ? 1 : 0;
                $course->certificate = $request->has('certificate') ? 1 : 0;
                $course->category_id = $request->category;
                $course->course_level_id = $request->level;
                $course->course_language_id = $request->language;
                $course->save();
        
                // For now, redirect to the next step (you can adjust this later)
                return response()->json([
                    'status' => 'success',
                    'message' => 'More Info Updated successfully',
                    'redirect' => route('instructor.courses.edit', ['course' => $course->id, 'step' => $request->next_step]),
                ]); 
                break;
            case '3':
                // code for step 3
                break;
            default:
                abort(404);
        }
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
