<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : view
    {
        return view('frontend.student-dashboard.index');
    }

    // become an insttructor method
    public function becomeInstructor()
    {
        return view('frontend.student-dashboard.become-instructor.index');
    }
}
