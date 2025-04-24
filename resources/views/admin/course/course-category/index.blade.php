@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Course Categories</h3>

                            <!-- Page title actions -->
                            <div class="card-actions">
                                <a href="{{ route('admin.course-category.create')}}" class="btn btn-primary btn-3">
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
            var status = $(this).val();
    
            var $row = $(this).closest('tr'); // Get the row
            var $showAtTrendingSelect = $row.find('.show_at_trending-select'); // Find show_at_trending select in the same row

            $.ajax({
                url: '{{ route('admin.course-category.update-status', ':id') }}'.replace(':id', id),
                type: 'POST',
                data: {
                    status: status
                },
                success: function (response) {
                    notyf.success('Status updated successfully');

                    // If status is turned off (0), also turn off show_at_trending
                    if (status == 0 && $showAtTrendingSelect.val() == 1) {
                        $showAtTrendingSelect.val(0); // Update the dropdown UI
                        $.ajax({
                            url: '{{ route('admin.course-category.update-show-at-trending', ':id') }}'.replace(':id', id),
                            type: 'POST',
                            data: {
                                show_at_trending: 0
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
            var show_at_trending = $(this).val();
            var $row = $(this).closest('tr'); // Get the row
            var $statusSelect = $row.find('.status-select'); // Find status select in the same row

            // If trying to enable show_at_trending while status is off
            if (show_at_trending == 1 && $statusSelect.val() == 0) {
                notyf.error('Cannot enable Show at Trending when Status is off');
                $(this).val(0); // Revert the change
                return; // Stop the AJAX request
            }

            $.ajax({
                url: '{{ route('admin.course-category.update-show-at-trending', ':id') }}'.replace(':id', id),
                type: 'POST',
                data: {
                    show_at_trending: show_at_trending
                },
                success: function (response) {
                    notyf.success('Show at Trending updated successfully');
                },
                error: function (xhr) {
                    var response = xhr.responseJSON;
                    if (response && response.error) {
                        notyf.error(response.error); // Show server-side error
                    } else {
                        notyf.error('Failed to update Show at Trending');
                    }
                    $(this).val($statusSelect.data('value')); // Revert on error
                }
            });
        });
    </script>
@endpush
