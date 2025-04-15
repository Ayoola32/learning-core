@extends('frontend.layouts.master')

@section('content')

    <!--===========================
       RESET PASSWORD START
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

                                <form method="POST" action="{{ route('password.store') }}">
                                @csrf
                                <h2>RESET PASSWORD<span>!</span></h2>
                                <div class="row">

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <!-- Email Address -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Email*</label>
                                            <input type="email" name="email" value="{{old('email', $request->email)}}" placeholder="Email" autofocus autocomplete="username">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Password*</label>
                                            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <label>Confirm Password*</label>
                                            <input type="password" name="password_confirmation" placeholder="Password" required autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('passpassword_confirmationword')" class="mt-2" />
                                        </div>
                                    </div>


                                    <!-- Button -->
                                    <div class="col-xl-12">
                                        <div class="wsus__login_form_input">
                                            <button type="submit" class="common_btn">Reset Password</button>
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
       RESET PASSWORD END
    ============================-->
@endsection
