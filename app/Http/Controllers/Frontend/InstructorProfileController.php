<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileSocialLinksUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorProfileController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('frontend.instructor-dashboard.profile.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'), 'uploads/profile_images');

            // Delete old image if exists
            if ($user->image) {
                $this->deleteFile($user->image);
            }

            $user->image = $imagePath;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->headline = $request->headline;
        $user->bio = $request->bio;
        $user->gender = $request->gender;

        $user->save();
        return redirect()->back();
    }


    /**
     * Update Email/Password.
     */
    public function updatePassword(ProfilePasswordUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);

        $user->save();
        return redirect()->back();
    }


    /**
     * Update Email/Password.
     */
    public function updateSocialLinks(ProfileSocialLinksUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->website = $request->website;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->linkedin = $request->linkedin;
        $user->github = $request->github;

        $user->save();
        return redirect()->back();
    }
}
