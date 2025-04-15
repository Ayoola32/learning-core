@extends('frontend.layouts.master')

@section('content')
    <!--===========================
        FORRGET PASSWORRD START
    ============================-->
    <section class="wsus__sign_in">
        <div class="row align-items-center">
            <div class="col-xxl-5 col-xl-6 col-lg-6 wow fadeInLeft">
                <div class="wsus__sign_img">
                    <img src="{{asset('frontend/assets/images/login_img_1.jpg')}}" alt="login" class="img-fluid">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-9 m-auto wow fadeInRight">
                <div class="wsus__sign_form_area">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <h2>Forgot Password<span>!</span></h2>
                                <p class="new_user">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</a></p>
                                <div class="row">

                                    <!-- Email Address -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email*</label>
                                            <input type="email" name="email" value="{{old('email')}}" placeholder="Email" autofocus autocomplete="username">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>


                                    <!-- Button -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <button type="submit" class="common_btn">Email Password Reset Link</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <p class="create_account">Remeber your password? <a href="{{route('login')}}">Back to Sign in page</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        FORRGET PASSWORRD END
    ============================-->


@endsection