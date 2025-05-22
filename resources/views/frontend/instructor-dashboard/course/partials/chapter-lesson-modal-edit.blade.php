<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Lesson</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ route('instructor.course-content.update-lesson', [$course->id, $chapter->id, $lesson->id])}}" method="post" enctype="multipart/form-data" class="lesson-update-form">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group mb-3 col-md-12">
                    <label for="title" class="form-label">Lesson Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $lesson->title }}" placeholder="Enter Lesson Title" required>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="form-group mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter Description">{!! $lesson->description !!}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="storage" class="form-label">Storage Type</label>
                    <select class="select_js form-control storage-lesson" name="storage" id="storage" required>
                        <option value="">Select Storage Type</option>
                        <option value="upload" @selected($lesson->storage == 'upload')>Upload</option>
                        <option value="youtube" @selected($lesson->storage == 'youtube')>YouTube</option>
                        <option value="vimeo" @selected($lesson->storage == 'vimeo')>Vimeo</option>
                        <option value="external_link" @selected($lesson->storage == 'external_link')>External Link</option>
                    </select>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="file_type" class="form-label">File Type</label>
                    <select name="file_type" id="file_type" class="form-control" required>
                        <option value="">Select File Type</option>
                        <option value="video" @selected($lesson->file_type == 'video')>Video</option>
                        <option value="audio" @selected($lesson->file_type == 'audio')>Audio</option>
                        <option value="document" @selected($lesson->file_type == 'document')>Document</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="add_course_basic_info_imput source_upload d-none">
                        <label for="file">Path</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control source_input" type="text" name="file" value="{{ $lesson->file_path }}">
                        </div>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                    <div class="add_course_basic_info_imput source_link d-none">
                        <label for="url">Link</label>
                        <input type="text" name="url" class="mb-3 source_input" placeholder="Link" value="{{ $lesson->file_path }}">
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="duration" class="form-label">Duration (minutes)</label>
                    <input type="number" class="form-control" id="duration" name="duration" value={{ $lesson->duration }} placeholder="Enter Duration" min="1">
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>
                <div class="form-group mb-3 col-md-6 add_course_more_info_checkbox">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_preview" value="1" id="preview" {{ $lesson->is_preview ? 'checked' : '' }}>
                        <label class="form-check-label" for="preview">Is Preview</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="downloadable" value="1" id="downloadable" {{ $lesson->downloadable ? 'checked' : '' }}>
                        <label class="form-check-label" for="downloadable">Downloadable</label>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="volume" class="form-label">Volume</label>
                    <input type="number" class="form-control" id="volume" name="volume" value="{{ $lesson->volume }}"placeholder="Enter volume" min="1">
                    <x-input-error :messages="$errors->get('volume')" class="mt-2" />
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active" @selected($lesson->status === 'active')>Active</option>
                        <option value="inactive" @selected($lesson->status === 'inactive')>Inactive</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
                

                <div class="form-group mb-3 text-end col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>