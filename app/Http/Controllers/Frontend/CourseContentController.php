<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseContentController extends Controller
{
    // createChapter
    public function createChapter()
    {
        return view('frontend.instructor-dashboard.course.partials.course-chapter-modal')->render();
    }
}
