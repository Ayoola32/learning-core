@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Sub-Category for <span class="text-blue">{{ $course_category->name}}</span></h3>

                            <!-- Page title actions -->
                            <div class="card-actions">
                                <a href="{{ route('admin.sub-category.create', $course_category->id)}}" class="btn btn-primary btn-3">
                                    <i class="ti ti-plus"></i> 
                                    Add new
                                </a>
                            </div>
                        </div>


                        <div class="card-body border-bottom py-3">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    {{-- Script for course catttegory status on page update --}}
    <script>
        // Initialize Notyf
        const notyf = new Notyf({
            duration: 4000, 
            position: { x: 'right', y: 'bottom' },
            dismissible: true 
        });
    
        // Initialize DataTable
        $(document).on('change', '.status-select', function () {
            var id = $(this).data('id');
            var category_id = $(this).data('category-id');
            var status = $(this).val();

            var $row = $(this).closest('tr');
            var $showAtTrendingSelect = $row.find('.show_at_trending-select');

            $.ajax({
            url: '/admin/' + category_id + '/sub-category/update-status/' + id,
            type: 'POST',
            data: {
                status: status,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                notyf.success('Status updated successfully');

                if (status == 0 && $showAtTrendingSelect.val() == 1) {
                    $showAtTrendingSelect.val(0);

                    $.ajax({
                        url: '/admin/' + category_id + '/sub-category/update-show-at-trending/' + id,
                        type: 'POST',
                        data: {
                            show_at_trending: 0,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function () {
                            notyf.success('Show at Trending turned off because Status is off');
                        },
                        error: function () {
                            notyf.error('Failed to update Show at Trending');
                        }
                    });
                }
            },
            error: function () {
                notyf.error('Failed to update status');
            }
        });
    });


    $(document).on('change', '.show_at_trending-select', function () {
        var id = $(this).data('id');
        var category_id = $(this).data('category-id');
        var show_at_trending = $(this).val();
        var $row = $(this).closest('tr');
        var $statusSelect = $row.find('.status-select');

        if (show_at_trending == 1 && $statusSelect.val() == 0) {
            notyf.error('Cannot enable Show at Trending when Status is off');
            $(this).val(0);
            return;
        }

        $.ajax({
            url: '/admin/' + category_id + '/sub-category/update-show-at-trending/' + id,
            type: 'POST',
            data: {
                show_at_trending: show_at_trending,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                notyf.success('Show at Trending updated successfully');
            },
            error: function () {
                notyf.error('Failed to update Show at Trending');
            }
        });
    });

    </script>
@endpush
