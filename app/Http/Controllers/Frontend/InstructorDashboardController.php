<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('frontend.instructor-dashboard.index');
    }
}
