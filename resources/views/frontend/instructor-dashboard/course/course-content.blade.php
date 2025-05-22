@extends('frontend.instructor-dashboard.course.course-app')

@section('course-content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <div class="add_course_content">
                <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
                    <a class="common_btn dynamic-modal-btn" href="#" data-id="{{ $course->id }}">Add New Chapter</a>
                    <a class="common_btn" href="#">Short Chapter</a>
                </div>

                <div class="accordion" id="accordionExample">
                    @foreach ($chapters as $chapter)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $chapter->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $chapter->id }}">
                                    <span>{{ $chapter->title }}</span>
                                </button>
                                <div class="add_course_content_action_btn">
                                    <div class="dropdown">
                                        <div class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="far fa-plus"></i>
                                        </div>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item add_lesson" href="#"
                                                    data-chapter-id={{ $chapter->id }}
                                                    data-course-id={{ $chapter->course_id }}>Add Lesson</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Add Document</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                                        </ul>
                                    </div>
                                    <a class="edit dynamic-modal-chapter" href="#" data-chapter-id="{{ $chapter->id}}" data-course-id="{{ $course->id }}"><i class="far fa-edit"></i></a>
                                    <a class="del delete-chapter" href="#" data-chapter-id="{{ $chapter->id}}" data-course-id="{{ $course->id }}"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </h2>
                            <div id="collapse{{ $chapter->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="item_list">
                                        @foreach ($chapter->chapterLessons as $lesson)
                                            <li>
                                                <span>{{ $lesson->title}}</span>
                                                <div class="add_course_content_action_btn">

                                                    <a class="edit edit-lesson" href="#" data-course-id="{{ $course->id }}" data-chapter-id="{{ $chapter->id }}" data-lesson-id="{{ $lesson->id }}"><i class="far fa-edit"></i></a>
                                                    <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                                                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
