<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index() : view
    {
        return view('frontend.student-dashboard.index');
    }

    // become an insttructor method
    public function becomeInstructor() : view
    {
        if (auth()->user()->role == 'instructor') abort(403);
        return view('frontend.student-dashboard.become-instructor.index');
    }

    public function becomeInstructorUpdate(Request $request, User $user) : RedirectResponse
    {
        $request->validate(['document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:12048']]);
        $filePath = $this->uploadFile($request->file('document'), 'uploads/instructor_documents');
        $user->update([
            'approval_status' => 'pending',
            'document' => $filePath,
        ]);

        return redirect()->route('student.dashboard');

    }
}
