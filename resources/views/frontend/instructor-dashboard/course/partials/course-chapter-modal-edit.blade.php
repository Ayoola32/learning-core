<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Chapter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ route('instructor.course-content.update-chapter', [$course->id, $chapter->id]) }}" method="post" class="chapter-update-form">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $chapter->title) }}" placeholder="Enter chapter title" required>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="form-group mb-3 text-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>