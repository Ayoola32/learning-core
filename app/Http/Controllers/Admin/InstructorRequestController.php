<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprrovedMail;
use App\Mail\InstructorRequestRejectMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InstructorRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $instructorRequests = User::where('approval_status', 'pending')->orWhere('approval_status', 'rejected')->get();
        return view('admin.instructor-requests.index', compact('instructorRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, User $instructor_request): RedirectResponse
    {

        $request->validate([
            'status' => ['required', 'in:approved,rejected,pending'],
        ]);
        $instructor_request->approval_status = $request->status;
        // Set role based on status
        if ($request->status === 'approved') {
            $instructor_request->role = 'instructor';
        } elseif ($request->status === 'rejected') {
            $instructor_request->role = 'student';
        }elseif ($request->status === 'pending') {
            $instructor_request->role = 'student';
        }

        $this->sendNotification($instructor_request);

        $instructor_request->save();
        return redirect()->back();
    }

    /**
     * Request for Download instructor submit file.
     */
    public function download(User $user)
    {
        return response()->download(public_path($user->document));

    }

    // Send Notification
    public function sendNotification($instructor_request) : void
    {
        switch ($instructor_request->approval_status) {
            case 'approved':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestApprrovedMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestApprrovedMail());
                }
                break;

            case 'rejected':
                if (config('mail_queue.is_queue')) {
                    Mail::to($instructor_request->email)->queue(new InstructorRequestRejectMail());
                } else {
                    Mail::to($instructor_request->email)->send(new InstructorRequestRejectMail());
                }
                break;
        }
    }
}
