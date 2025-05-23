@extends('frontend.instructor-dashboard.course.course-app')

@section('course-content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="dashboard_add_course_finish">
            <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST" class="finish_course_form">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $course->id }}">
                <input type="hidden" name="current_step" value="4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_more_info_input">
                            <label for="#">Message for Reviewer</label>
                            <textarea rows="7" name="message_for_reviewer" placeholder="Message for Reviewer">{!! $course->message_for_reviewer !!}</textarea>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_more_info_input mb-0">
                            <label for="#">Status *</label>
                            <select class="select_2" name="status">
                                <option value=""> Please Select </option>
                                <option @selected($course->status == 'active') value="active">Active</option>
                                <option @selected($course->status == 'draft') value="draft">Draft</option>
                            </select>
                            <p class="mt-2">If you select "Active", your course will be submitted for admin review and
                                approval.</p>
                            <button type="submit" class="common_btn mt_25">Complete</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-success" id="successModalLabel">Course Submission Successful</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="successMessage"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
