@extends('frontend.pages.courses.course-app')
@section('course-content')

    <div class="row">
        @foreach ($courses as $course)
        <div class="col-xl-4 col-md-6 wow fadeInUp">
            <div class="wsus__single_courses_3">
                    <div class="wsus__single_courses_3_img">
                        <img src="{{ $course->thumbnail }}" alt="Courses" class="img-fluid">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/images/love_icon_black.png')}}" alt="Love" class="img-fluid">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                        class="img-fluid">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                </a>
                            </li>
                        </ul>
                        <span class="time"><i class="far fa-clock"></i> {{ $course->duration }} Hours</span>
                    </div>
                    <div class="wsus__single_courses_text_3">
                        <div class="rating_area">
                            <!-- <a href="#" class="category">Design</a> -->
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>(4.8 Rating)</span>
                            </p>
                        </div>

                        <a class="title" href="{{ route('course.details', $course->slug)}}">{{ $course->title }}</a>
                        <ul>
                            <li>{{ $course->courseChapters->sum(fn($chapter) => $chapter->chapterLessons->count()) }} Lessons</li>
                            <li>38 Student</li>
                        </ul>
                        <a class="author" href="#">
                            <div class="img">
                                <img src="{{ $course->instructor->image }}" alt="Author" class="img-fluid">
                            </div>
                        <h4>{{ $course->instructor ? ($course->instructor->first_name . ' ' . $course->instructor->last_name) : 'Instructor' }}</h4>                        </a>
                    </div>
                    <div class="wsus__single_courses_3_footer">
                        <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                        <p><del>$254</del> ${{$course->price}}.00</p>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="wsus__pagination mt_50 wow fadeInUp">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <i class="far fa-arrow-left"></i>
                    </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">01</a></li>
                <li class="page-item"><a class="page-link" href="#">02</a></li>
                <li class="page-item"><a class="page-link" href="#">03</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <i class="far fa-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </nav>

        {{ $courses->links() }}
    </div>

@endsection
