<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <title>Learning-Core - Online Courses & Education</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated_barfiller.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/scroll_button.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/pointer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/range_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/startRating.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/video_player.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.simple-bar-graph.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/sticky_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">

    <link rel=" stylesheet" href="{{ asset('frontend/assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
</head>

<body class="home_3">


    <!--============ PRELOADER START ===========-->
    <div id="preloader">
        <div class="preloader_icon">
            <img src="{{ asset('frontend/assets/images/preloader.png') }}" alt="Preloader" class="img-fluid">
        </div>
    </div>
    <!--============ PRELOADER START ===========-->

    {{-- HEADER START --}}
        @include('frontend.layouts.header')
    {{-- HEADER END --}}


    <!--===========================
        BANNER 3 START
    ============================-->
    {{-- @include('frontend.pages.home.sections.hero.section') --}}
        @include('frontend.pages.home.sections.hero-section')
    <!--===========================
        BANNER 3 END
    ============================-->


    <!--===========================
        CATEGORY 4 START
    ============================-->
        @include('frontend.pages.home.sections.category-section')
    <!--===========================
        CATEGORY 4 END
    ============================-->


    <!--===========================
        ABOUT 3 START
    ============================-->
        @include('frontend.pages.home.sections.about-section')
    <!--===========================
        ABOUT 3 END
    ============================-->


    <!--===========================
        COUESES 3 START
    ============================-->
        @include('frontend.pages.home.sections.courses-section')
    <!--===========================
        COUESES 3 END
    ============================-->


    <!--===========================
        OFFER START
    ============================-->
        @include('frontend.pages.home.sections.offer-section')
    <!--===========================
        OFFER END
    ============================-->


    <!--===========================
        BECOME INSTRUCTOR START
    ============================-->
        @include('frontend.pages.home.sections.become-instructor-section')
    <!--===========================
        BECOME INSTRUCTOR END
    ============================-->


    <!--===========================
        VIDEO START
    ============================-->
        @include('frontend.pages.home.sections.video-section')
    <!--===========================
        VIDEO END
    ============================-->


    <!--===========================
        BRAND START
    ============================-->
        @include('frontend.pages.home.sections.brand-section')
    <!--===========================
        BRAND END
    ============================-->


    <!--===========================
        QUALITY COURSES START
    ============================-->
    <section class="wsus__quality_courses mt_120 xs_mt_100">
        <div class="row quality_course_slider">
            <div class="quality_course_slider_item" style="background: url(images/quality_courses_bg.jpg);">
                <div class="col-12">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                            <div class="wsus__quality_courses_text">
                                <div class="wsus__section_heading heading_left mb_30">
                                    <h5>100% QUALITY COURSES</h5>
                                    <h2>Find Your Match From The Spotlighted Collection</h2>
                                </div>
                                <p>Quisque vitae dignissim nunc, a molestie nisi. Orci varius natoque penatibus
                                    parturient
                                    nascetu
                                    mus.</p>
                                <a class="common_btn" href="#">all Featured Courses <i
                                        class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                            <div class="wsus__quality_courses_img">
                                <img src="images/quality_courses_img.png" alt="Quality Courses"
                                    class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-md-6 col-lg-5 wow fadeInUp">
                            <div class="row quality_course_card_slider">
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="images/courses_3_img_1.jpg" alt="Courses"
                                                class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/love_icon_black.png" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/compare_icon_black.png" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/cart_icon_black_2.png" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D
                                                Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="images/author_img_2.jpg" alt="Author"
                                                        class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="images/courses_3_img_2.jpg" alt="Courses"
                                                class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/love_icon_black.png" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/compare_icon_black.png" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/cart_icon_black_2.png" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">

                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.9 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">50 Tips For Designing an Exceptional
                                                Online Learning Progress.</a>
                                            <ul>
                                                <li>32 Lessons</li>
                                                <li>48 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="images/author_img_2.jpg" alt="Author"
                                                        class="img-fluid">
                                                </div>
                                                <h4>Hugh Millie-Yate</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p>$239.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="images/courses_3_img_3.jpg" alt="Courses"
                                                class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/love_icon_black.png" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/compare_icon_black.png" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/cart_icon_black_2.png" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <!-- <a href="#" class="category">Marketing</a> -->
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Holistic Internet-Based Instruction
                                                Mastery Program.</a>
                                            <ul>
                                                <li>37 Lessons</li>
                                                <li>56 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="images/author_img_2.jpg" alt="Author"
                                                        class="img-fluid">
                                                </div>
                                                <h4>Dominic L. Ement</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p>$199.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quality_course_slider_item" style="background: url(images/quality_courses_bg.jpg);">
                <div class="col-12">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                            <div class="wsus__quality_courses_text">
                                <div class="wsus__section_heading heading_left mb_30">
                                    <h5>100% QUALITY COURSES</h5>
                                    <h2>Find Your Match From The Spotlighted Collection</h2>
                                </div>
                                <p>Quisque vitae dignissim nunc, a molestie nisi. Orci varius natoque penatibus
                                    parturient
                                    nascetu
                                    mus.</p>
                                <a class="common_btn" href="#">all Featured Courses <i
                                        class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                            <div class="wsus__quality_courses_img">
                                <img src="images/quality_courses_img_2.png" alt="Quality Courses"
                                    class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-md-6 col-lg-5 wow fadeInUp">
                            <div class="row quality_course_card_slider">
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="images/courses_3_img_1.jpg" alt="Courses"
                                                class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/love_icon_black.png" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/compare_icon_black.png" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/cart_icon_black_2.png" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D
                                                Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="images/author_img_2.jpg" alt="Author"
                                                        class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="images/courses_3_img_2.jpg" alt="Courses"
                                                class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/love_icon_black.png" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/compare_icon_black.png" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/cart_icon_black_2.png" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">

                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.9 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">50 Tips For Designing an Exceptional
                                                Online Learning Progress.</a>
                                            <ul>
                                                <li>32 Lessons</li>
                                                <li>48 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="images/author_img_2.jpg" alt="Author"
                                                        class="img-fluid">
                                                </div>
                                                <h4>Hugh Millie-Yate</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p>$239.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="images/courses_3_img_3.jpg" alt="Courses"
                                                class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/love_icon_black.png" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/compare_icon_black.png" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="images/cart_icon_black_2.png" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Holistic Internet-Based Instruction
                                                Mastery Program.</a>
                                            <ul>
                                                <li>37 Lessons</li>
                                                <li>56 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="images/author_img_2.jpg" alt="Author"
                                                        class="img-fluid">
                                                </div>
                                                <h4>Dominic L. Ement</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p>$199.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        QUALITY COURSES END
    ============================-->


    <!--===========================
        TESTIMONIAL START
    ============================-->
    <section class="wsus__testimonial pt_120 xs_pt_80">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 m-auto wow fadeInUp">
                    <div class="wsus__section_heading mb_40">
                        <h5>Testimonial</h5>
                        <h2>Comments From Our Learners</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row testimonial_slider">
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="images/testimonial_logo.png" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="images/testimonial_user_1.png" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Spruce Springclean
                            <span>Computer Engineer</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="images/testimonial_logo_2.png" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="images/testimonial_user_2.png" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Ravi O'Leigh
                            <span>IT Director at Cognizant</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="images/testimonial_logo_3.png" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="images/testimonial_user_3.png" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Hanson Deck
                            <span>UX Design Lead</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="images/testimonial_logo_2.png" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="images/testimonial_user_2.png" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Spruce Springclean
                            <span>Computer Engineer</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        TESTIMONIAL END
    ============================-->


    <!--===========================
        BLOG 4 START
    ============================-->
    <section class="blog_4 mt_110 xs_mt_90 pt_120 xs_pt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 wow fadeInLeft">
                    <div class="wsus__section_heading heading_left mb_50">
                        <h5>Latest blogs</h5>
                        <h2>Our Latest News Feed.</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row blog_4_slider">
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="images/blog_4_img_1.jpg" alt="Blog" class="img-fluid">
                        <span class="date">March 23, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="images/user_icon_black.png" alt="User"
                                        class="img-fluid"></span>
                                By Richard Tea
                            </li>
                            <li>
                                <span><img src="images/comment_icon_black.png" alt="Comment"
                                        class="img-fluid"></span>
                                3 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Exploring Learning Landscapes in Academic.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="images/blog_4_img_2.jpg" alt="Blog" class="img-fluid">
                        <span class="date">April 28, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="images/user_icon_black.png" alt="User"
                                        class="img-fluid"></span>
                                By Doug Lyphe
                            </li>
                            <li>
                                <span><img src="images/comment_icon_black.png" alt="Comment"
                                        class="img-fluid"></span>
                                21 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Uncovering Learning Opportunities in Academia.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="images/blog_4_img_3.jpg" alt="Blog" class="img-fluid">
                        <span class="date">Jan 12, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="images/user_icon_black.png" alt="User"
                                        class="img-fluid"></span>
                                By Eleanor Fant
                            </li>
                            <li>
                                <span><img src="images/comment_icon_black.png" alt="Comment"
                                        class="img-fluid"></span>
                                48 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Internationally Distinguished Skillful Educators.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="images/blog_4_img_4.jpg" alt="Blog" class="img-fluid">
                        <span class="date">April 28, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="images/user_icon_black.png" alt="User"
                                        class="img-fluid"></span>
                                By Doug Lyphe
                            </li>
                            <li>
                                <span><img src="images/comment_icon_black.png" alt="Comment"
                                        class="img-fluid"></span>
                                21 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Uncovering Learning Opportunities in Academia.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        BLOG 4 END
    ============================-->


    <!--===========================
        FOOTER 3 START
    ============================-->
@include('frontend.layouts.footer')
    <!--===========================
        FOOTER 3 END
    ============================-->


    <!--================================
        SCROLL BUTTON START
    =================================-->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!--================================
        SCROLL BUTTON END
    =================================-->


    <!--jquery library js-->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/assets/js/Font-Awesome.js') }}"></script>
    <!--marquee js-->
    <script src="{{ asset('frontend/assets/js/jquery.marquee.min.js') }}"></script>
    <!--slick js-->
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    <!--countup js-->
    <script src="{{ asset('frontend/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countup.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>
    <!--nice-select js-->
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <!--Scroll Button js-->
    <script src="{{ asset('frontend/assets/js/scroll_button.js') }}"></script>
    <!--pointer js-->
    <script src="{{ asset('frontend/assets/js/pointer.js') }}"></script>
    <!--range slider js-->
    <script src="{{ asset('frontend/assets/js/range_slider.js') }}"></script>
    <!--barfiller js-->
    <script src="{{ asset('frontend/assets/js/animated_barfiller.js') }}"></script>
    <!--calendar js-->
    <script src="{{ asset('frontend/assets/js/jquery.calendar.js') }}"></script>
    <!--starRating js-->
    <script src="{{ asset('frontend/assets/js/starRating.js') }}"></script>
    <!--Bar Graph js-->
    <script src="{{ asset('frontend/assets/js/jquery.simple-bar-graph.min.js') }}"></script>
    <!--select2 js-->
    <script src="{{ asset('frontend/assets/js/select2.min.js') }}"></script>
    <!--Video player js-->
    <script src="{{ asset('frontend/assets/js/video_player.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/video_player_youtube.js') }}"></script>
    <!--wow js-->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>

    <!--main/custom js-->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

</body>

</html>
