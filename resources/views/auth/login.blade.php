@extends('frontend.layouts.master')

@section('content')

    <!--===========================
        SIGN IN START
    ============================-->
    <section class="wsus__sign_in" style="margin-top: 100px;">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="{{asset('frontend/assets/images/login_img_1.jpg')}}" alt="login" class="img-fluid">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Student | Instructor</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <h2>Log in<span>!</span></h2>
                                <p class="new_user">Welcome back, please provide your login details</a></p>
                                <div class="row">

                                    <!-- Email Address -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email*</label>
                                            <input type="email" name="email" value="{{old('email')}}" placeholder="Email" autofocus autocomplete="username">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password* <a href="{{route('password.request')}}">Forgot Password?</a></label>
                                            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>


                                    <!-- Remember Me -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <div class="form-check">
                                                <input class="form-check-input" name="remember" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Remember Me
                                                </label>
                                            </div>
                                            <button type="submit" class="common_btn">Sign In</button>
                                        </div>
                                    </div>




                                </div>
                            </form>

                            <p class="create_account">Don't have an account? <a href="{{route('register')}}">Create free
                                    account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="back_btn" href="index.html">Back to Home</a>
    </section>
    <!--===========================
        SIGN IN END
    ============================-->

    
@endsection