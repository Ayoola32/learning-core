
@extends('frontend.layouts.master')

@section('content')

    <!--===========================
        BREADCRUMB START
    ============================-->
<section class="wsus__breadcrumb" style="background: url('{{ asset('frontend/assets/images/breadcrumb_bg.jpg') }}');">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Courses</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Overview</li>
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

<section class="wsus__courses mt_120 xs_mt_100 pb_120 xs_pb_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-8 order-2 order-lg-1 wow fadeInLeft">
                <div class="wsus__sidebar">
                    <form action="#">
                        <div class="wsus__sidebar_search">
                            <input type="text" placeholder="Search Course">
                            <button type="submit">
                                <img src="{{ asset('frontend/assets/images/search_icon.png') }}" alt="Search" class="img-fluid">
                            </button>
                        </div>

                        <div class="wsus__sidebar_category">
                            <h3>Categories</h3>
                            <ul class="categoty_list">
                                @foreach ($categories as $category)
                                    <li>
                                        @if ($category->subCategories->isNotEmpty())
                                            {{ $category->name }}
                                            <div class="wsus__sidebar_sub_category">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="{{ $subCategory->id }}"
                                                            id="subCategory_{{ $subCategory->id }}" name="subcategory[]">
                                                        <label class="form-check-label" for="subCategory_{{ $subCategory->id }}">
                                                            {{ $subCategory->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </li>
                                @endforeach                            
                            </ul>
                        </div>

                        <div class="wsus__sidebar_course_lavel">
                            <h3>Difficulty Level</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Higher
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    Medium
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    Lowest
                                </label>
                            </div>
                        </div>

                        <div class="wsus__sidebar_course_lavel rating">
                            <h3>Rating</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr1">
                                <label class="form-check-label" for="flexCheckDefaultr1">
                                    <i class="fas fa-star"></i> 5 star
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr2">
                                <label class="form-check-label" for="flexCheckDefaultr2">
                                    <i class="fas fa-star"></i> 4 star or above
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr3">
                                <label class="form-check-label" for="flexCheckDefaultr3">
                                    <i class="fas fa-star"></i> 3 star or above
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr4">
                                <label class="form-check-label" for="flexCheckDefaultr4">
                                    <i class="fas fa-star"></i> 2 star or above
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultr5">
                                <label class="form-check-label" for="flexCheckDefaultr5">
                                    <i class="fas fa-star"></i> 1 star or above
                                </label>
                            </div>
                        </div>

                        <div class="wsus__sidebar_course_lavel duration">
                            <h3>Duration</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultd1">
                                <label class="form-check-label" for="flexCheckDefaultd1">
                                    Less Than 24 Hours
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultd2">
                                <label class="form-check-label" for="flexCheckDefaultd2">
                                    24 to 36 Hours
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultd3">
                                <label class="form-check-label" for="flexCheckDefaultd3">
                                    36 to 72 Hours
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultd4">
                                <label class="form-check-label" for="flexCheckDefaultd4">
                                    Above 70 Hours
                                </label>
                            </div>
                        </div>

                        <div class="wsus__sidebar_course_lavel duration">
                            <h3>Language</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaulte1">
                                <label class="form-check-label" for="flexCheckDefaulte1">
                                    Bangla
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaulte2">
                                <label class="form-check-label" for="flexCheckDefaulte2">
                                    English
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaulte3">
                                <label class="form-check-label" for="flexCheckDefaulte3">
                                    Hindi
                                </label>
                            </div>
                        </div>

                        <div class="wsus__sidebar_rating">
                            <h3>Price Range</h3>
                            <div class="range_slider"></div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 order-lg-1">
                <div class="wsus__page_courses_header wow fadeInUp">
                    <p>Showing <span>1-9</span> Of <span>62</span> Results</p>
                    <form action="#">
                        <p>Sort-by:</p>
                        <select class="select_js">
                            <option value="">Regular</option>
                            <option value="">Top Rated</option>
                            <option value="">Popular Courses</option>
                            <option value="">Recent Courses</option>
                        </select>
                    </form>
                </div>

                @yield('course-content')

            </div>
        </div>
    </div>
</section>

@endsection