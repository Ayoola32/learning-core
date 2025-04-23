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
    
        $(document).on('change', '.status-select', function () {
            var id = $(this).data('id');
            var status = $(this).val();
    
            $.ajax({
                url: '{{ route('admin.course-category.update-status', ':id') }}'.replace(':id', id),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function (response) {
                    notyf.success('Status updated successfully');
                },
                error: function () {
                    notyf.error('Failed to update status');
                }
            });
        });
    </script>
@endpush
