@extends('frontend.instructor-dashboard.course.course-app')

@section('course-content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <form action="{{ route('instructor.courses.update', $course->id) }}" class="more_info_form cou
                git rse-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $course->id }}">
                <input type="hidden" name="current_step" value="2">
                <input type="hidden" name="next_step" value="3">

                <div class="row">
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="#">Capacity</label>
                            <input type="text" name="capacity" placeholder="Capacity"value="{{ $course->capacity }}">
                            <p>leave blank for unlimited</p>
                            <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label for="#">Course Duration (Minutes)*</label>
                            <input type="text" name="duration" placeholder="300" value="{{ $course->duration }}">
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="qna" value="1" id="flexCheckDefault" {{ $course->qna ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">Q&A</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="certificate" value="1" id="flexCheckDefault2" {{ $course->certificate ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault2">Completion Certificate</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="add_course_more_info_input">
                            <label for="#">Category *</label>
                            <select class="select_2" name="category">
                                <option value=""> Please Select </option>
                                @foreach ($categories as $category)
                                    @if ($category->subCategories->isNotEmpty())
                                        <optgroup label="{{ $category->name }}">
                                            @foreach ($category->subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}" {{ $course->category_id == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Level</h3>
                            @foreach ($courseLevels as $level)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{ $level->id }}" name="level" id="id-{{ $level->id }}" {{ $course->course_level_id == $level->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="id-{{ $level->id }}">
                                        {{ $level->name }}
                                    </label>
                                </div>
                            @endforeach
                            <x-input-error :messages="$errors->get('level')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Language</h3>
                            @foreach ($courseLanguages as $language)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{ $language->id }}" name="language" id="id-{{ $language->id }}" {{ $course->course_language_id == $language->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="id-{{ $language->id }}">
                                        {{ $language->name }}
                                    </label>
                                </div>
                            @endforeach
                            <x-input-error :messages="$errors->get('language')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const courseId = "{{ $course->id }}";
    </script>
@endsection