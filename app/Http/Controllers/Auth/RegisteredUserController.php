<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use FileUpload;

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->type == 'student') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'approval_status' => 'approved',
            ]);
        }elseif ($request->type == 'instructor') {
            $request->validate(['document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:12048']]);
            $filePath = $this->uploadFile($request->file('document'), 'uploads/instructor_documents');
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'document' => $filePath,
                'approval_status' => 'pending',
            ]);

        }else {
            return redirect()->back()->withErrors(['type' => 'Invalid user type selected.']);
        }


        event(new Registered($user));

        Auth::login($user);


        if ($request->user()->role == 'student') {
            return redirect()->intended(route('student.dashboard', absolute: false));
        } elseif ($request->user()->role == 'instructor') {
            return redirect()->intended(route('instructor.dashboard', absolute: false));
        }

        // Default redirect if no role matches
        return redirect()->route('home');
    }
}
