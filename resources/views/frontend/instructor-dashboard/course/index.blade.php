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
                            <h1>Instructor Dashboard</h1>
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


    <!--===========================
        DASHBOARD OVERVIEW START
    ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.instructor-dashboard.sidebar')

                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                                <a class="common_btn" href="{{ route('instructor.courses.create') }}">+ add course</a>
                            </div>
                        </div>

                        @if ($courses->isNotEmpty())
                            <form action="#" class="wsus__dash_course_searchbox">
                                <div class="input">
                                    <input type="text" placeholder="Search our Courses">
                                    <button><i class="far fa-search"></i></button>
                                </div>
                                <div class="selector">
                                    <select class="select_js">
                                        <option value="">Active</option>
                                        <option value="">Pending</option>
                                        <option value="">Decline</option>
                                    </select>
                                </div>
                            </form>

                            <div class="wsus__dash_course_table">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th class="image"> COURSES </th>
                                                        <th class="details"></th>

                                                        <th class="sale">STUDENT</th>
                                                        <th class="status">STATUS</th>
                                                        <th class="action">ACTION</th>
                                                    </tr>

                                                    @foreach ($courses as $course)
                                                        <tr>
                                                            <td class="image">
                                                                <div class="image_category">
                                                                    <img src="{{ asset($course->thumbnail) }}"
                                                                        alt="Thumbnail" class="img-fluid w-100">
                                                                </div>
                                                            </td>
                                                            <td class="details">
                                                                <p class="rating">
                                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                                    <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                                    <i class="far fa-star" aria-hidden="true"></i>
                                                                    <span>(5.0)</span>
                                                                </p>
                                                                <a class="title" href="#">{{ $course->title }}</a>

                                                            </td>
                                                            <td class="sale">
                                                                <p>16</p>
                                                            </td>
                                                            <td class="status">
                                                                @if ($course->status == 'active')
                                                                    <p class="active">Active</p>
                                                                @elseif ($course->status == 'pending')
                                                                    <p class="bg-warning">Pending</p>
                                                                @elseif ($course->status == 'decline')
                                                                    <p class="bg-danger">Decline</p>
                                                                @elseif ($course->status == 'draft')
                                                                    <p class="bg-info">Draft</p>
                                                                @endif
                                                            </td>
                                                            <td class="action">
                                                                <a class="edit"
                                                                    href="{{ route('instructor.courses.edit', ['course' => $course->id, 'step' => 1]) }}"><i
                                                                        class="far fa-edit"></i></a>
                                                                <a class="del" href="#"><i
                                                                        class="fas fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @elseif ($courses->isEmpty())
                            <div class="text-center mt-5 mb-5 ">
                                <h4 class="text-danger">No Course Found</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        DASHBOARD OVERVIEW END
    ============================-->
@endsection
