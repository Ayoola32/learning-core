<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Lesson</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ route('instructor.course-content.store-lesson', [$course->id, $chapter->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group mb-3 col-md-12">
                    <label for="title" class="form-label">Lesson Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Lesson Title" required>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="form-group mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter Description"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="storage" class="form-label">Storage Type</label>
                    <select class="select_js form-control storage-lesson" name="storage" id="storage" required>
                        <option value="">Select Storage Type</option>
                        <option value="upload">Upload</option>
                        <option value="youtube">YouTube</option>
                        <option value="vimeo">Vimeo</option>
                        <option value="external_link">External Link</option>
                    </select>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="file_type" class="form-label">File Type</label>
                    <select name="file_type" id="file_type" class="form-control" required>
                        <option value="">Select File Type</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                        <option value="document">Document</option>
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
                <div class="form-group mb-3 text-end col-md-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>