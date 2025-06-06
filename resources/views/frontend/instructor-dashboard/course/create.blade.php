@extends('frontend.instructor-dashboard.course.course-app')

@section('course-content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data" class="basic_info_form">
                @csrf
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="next_step" value="2">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" placeholder="Title">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Seo description</label>
                            <input type="text" name="seo_description" placeholder="Seo description">
                            <x-input-error :messages="$errors->get('seo_description')" class="mt-2" />

                        </div>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Thumbnail <span class="text-danger">*</span></label>
                            <input type="file" name="thumbnail" class="">
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                            <p>Image size should be 600x400</p>                            
                        </div>
                    </div>
                    
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">
                            <label for="demo_video_storage">Demo Video Storage <b>(optional)</b></label>
                            <select class="select_js storage" name="demo_video_storage" id="demo_video_storage">
                                <option value="">Please Select</option>
                                <option value="upload">Upload</option>
                                <option value="youtube">Youtube</option>
                                <option value="vimeo">Vimeo</option>
                                <option value="external_link">External Link</option>
                            </select>
                            <x-input-error :messages="$errors->get('demo_video_storage')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput source_upload d-none">
                            <label for="file">Path</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control source_input" type="text" name="file">
                            </div>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>
                        <div class="add_course_basic_info_imput source_link d-none">
                            <label for="url">Link</label>
                            <input type="text" name="url" class="mb-3 source_input" placeholder="Link">
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Price <span class="text-danger">*</span></label>
                            <input type="text" name="price" placeholder="Price">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            <p>Put 0 for free</p>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Discount Price</label>
                            <input type="text" name="discount" placeholder="Discount Price">
                            <x-input-error :messages="$errors->get('discount')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput mb-0">
                            <label for="#">Description</label>
                            <textarea rows="8" name="description" placeholder="Description"></textarea>
                            <button type="submit" class="common_btn mt_20">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
