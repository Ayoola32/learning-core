@extends('frontend.layouts.master')

@section('content')
    <!--===========================
        BREADCRUMB START
    ============================-->
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Profile</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ route('instructor.dashboard') }}">Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--===========================
        BREADCRUMB END
    ============================-->


    <!--===========================
        PROFILE OVERVIEW START
    ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">

                @include('frontend.instructor-dashboard.sidebar')

                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    {{-- PROFILE DETAILS UPDATE --}}
                    <div class="wsus__dashboard_contant bg-light">

                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Information</h5>
                                <p>Update and manage your information in real-time.</p>
                            </div>
                            <div class="wsus__dashboard_profile_delete">
                                {{-- <a href="#" class="common_btn">Delete Profile</a> --}}
                            </div>
                        </div>

                        <form action="{{ route('instructor.profile.update') }}" method="POST" class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                            @csrf

                            <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
                                <div class="img">
                                    <img src="{{ asset(auth()->user()->image) }}" alt="profile" class="img-fluid w-100">
                                    <label for="profile_photo">
                                        <img src="{{ asset('frontend/assets/images/dash_camera.png') }}" alt="camera"
                                            class="img-fluid w-100">
                                    </label>
                                    <input type="file" name="image" id="profile_photo" hidden="">
                                </div>
                                <div class="text">
                                    <h6>Your avatar</h6>
                                    <p>PNG or JPG no bigger than 400px wide and tall.</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" value="{{ auth()->user()->first_name}}" placeholder="Enter your First name">
                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" value="{{ auth()->user()->last_name}}"placeholder="Enter your Last name">
                                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ auth()->user()->email}}" placeholder="Enter your Email">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Gender</label>
                                        <select name="gender" id="" class="form-control gender-options">
                                            <option value="">Select</option>
                                            <option @selected(auth()->user()->gender == 'male') value="male">Male</option>
                                            <option @selected(auth()->user()->gender == 'female') value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Headline</label>
                                        <textarea rows="2" name="headline" placeholder="Your Headline here">{{ auth()->user()->headline }}</textarea>
                                        <x-input-error :messages="$errors->get('headline')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>About Me</label>
                                        <textarea rows="7" name="bio" placeholder="About Yourself here!">{{ auth()->user()->bio }}</textarea>
                                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>



                    {{-- PASSWORD UPDATE --}}
                    <div class="wsus__dashboard_contant bg-light">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Password</h5>
                                <p>Update and manage your information in real-time.</p>
                            </div>

                        </div>

                        <form action="{{ route('instructor.profile.update-password')}}" method="POST"
                            class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" placeholder="Enter your Current Password" autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>New Password</label>
                                        <input type="password" name="password" placeholder="Enter your New Password" autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation" placeholder="Enter your New Password" autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    {{-- SOCIAL LINKS UPDATE --}}
                    <div class="wsus__dashboard_contant bg-light">

                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Social Link Infos</h5>
                                <p>Update and manage your information in real-time.</p>
                            </div>
                        </div>


                        <form action="{{ route('instructor.profile.update-social-links')}}" method="POST" class="wsus__dashboard_profile_update">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Website</label>
                                        <input type="text" name="website" value="{{auth()->user()->website}}" placeholder="Enter your Website Address">
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Facebook</label>
                                        <input type="text" name="facebook" value= "{{auth()->user()->facebook}}" placeholder="Facebook Profile URL">
                                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>X - (Twitter)</label>
                                        <input type="text" name="twitter" value="{{auth()->user()->twitter}}" placeholder="Twitter Profile URL">
                                        <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>LinkedIn</label>
                                        <input type="text" name="linkedin"  value="{{auth()->user()->linkedin}}" placeholder="LinkedIn Profile URL">
                                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label>Github</label>
                                        <input type="text" name="github" value="{{auth()->user()->github}}" placeholder="Github Profile URL">
                                        <x-input-error :messages="$errors->get('github')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="wsus__dashboard_profile_update_btn">
                                    <button type="submit" class="common_btn">Update Social Links</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        </div>
    </section>
    <!--===========================
        PROFILE OVERVIEW END
    ============================-->
@endsection
