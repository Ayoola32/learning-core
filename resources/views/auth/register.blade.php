@extends('frontend.layouts.master')

@section('content')

    <!--===========================
        SIGN UP START
    ============================-->
    <section class="wsus__sign_in sign_up">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="{{asset('frontend/assets/images/login_img_2.jpg')}}" alt="login" class="img-fluid">
                </div>
            </div>
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Student</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Instructor</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">

                            <form action="{{ route('register', ['type' => 'student']) }}" method="POST">
                                @csrf

                                <h2>Sign Up<span>!</span></h2>
                                <p class="new_user">Already have an account? <a href="{{route('login')}}">Sign In</a></p>
                                <div class="row">

                                    <!-- Name -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Name</label>
                                            <input type="text" name="name" placeholder="Name" value="{{old('name')}}" autofocus autocomplete="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>


                                    <!-- Email Address -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Your email</label>
                                            <input type="email" name="email" placeholder="Your email" value="{{old('email')}}" autocomplete="username">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>


                                    
                                    <!-- Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Your password" autocomplete="off">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="off">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" required>
                                                <label class="form-check-label" for="flexCheckDefault"> By clicking
                                                    Create account, I agree that I have read and accepted the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy.</a>
                                                </label>
                                            </div>
                                            <button type="submit" class="common_btn">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab" tabindex="0">
                            <form action="{{ route('register', ['type' => 'instructor']) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h2>Sign up as an Instructor <span>!</span></h2>
                                <p class="new_user">Already have an account? <a href="{{route('login')}}">Sign In</a></p>
                                <div class="row">

                                    <!-- Name -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Name</label>
                                            <input type="text" name="name" placeholder="Name" value="{{old('name')}}" autofocus autocomplete="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>


                                    <!-- Email Address -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Your email</label>
                                            <input type="email" name="email" placeholder="Your email" value="{{old('email')}}" autocomplete="username">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>


                                    
                                    <!-- Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Your password" autocomplete="off">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="off">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Document File -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Document (Education / Certifications)</label>
                                            <input type="file" name="document" required>
                                            <x-input-error :messages="$errors->get('document')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" required>
                                                <label class="form-check-label" for="flexCheckDefault"> By clicking
                                                    Create account, I agree that I have read and accepted the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy.</a>
                                                </label>
                                            </div>
                                            <button type="submit" class="common_btn">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        SIGN UP END
    ============================-->

@endsection
