<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sort Chapters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <ul class="chapter-sortable-list">
            @foreach ($chapters as $chapter)
                <li data-chapter-id="{{ $chapter->id }}">
                    <span class="chapter-title">{{ $chapter->title }}</span>
                    <a class="arrow" href="#"><i class="fas fa-arrows-alt"></i></a>
                </li>
            @endforeach
        </ul>
        <div class="text-end mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>