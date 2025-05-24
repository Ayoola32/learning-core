@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Courses</h3>

                            <!-- Page title actions -->
                            <div class="card-actions">
                                <a href="" class="btn btn-primary btn-3">
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

    <script type="module">
        $(document).ready(function () {
            $(document).on('change', '.is_approved-select', function () {
                const courseId = $(this).data('id');
                const newStatus = $(this).val();
                const row = $(this).closest('tr');
                const statusCell = row.find('td').eq(3); // Status column (index 3, zero-based)

                $.ajax({
                    url: `/admin/courses/is_approved/${courseId}`,
                    type: 'POST',
                    data: {
                        is_approved: newStatus,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            let badgeClass, badgeText;
                            if (newStatus === 'approved') {
                                badgeClass = 'badge bg-green text-green-fg';
                                badgeText = 'Approved';
                            } else if (newStatus === 'rejected') {
                                badgeClass = 'badge bg-red text-red-fg';
                                badgeText = 'Rejected';
                            } else {
                                badgeClass = 'badge bg-yellow text-yellow-fg';
                                badgeText = 'Pending';
                            }
                            statusCell.html(`<span class="${badgeClass}">${badgeText}</span>`);

                            // Show success message
                            if (window.Notyf) {
                                new Notyf().success(`Course status updated to ${badgeText}`);
                            } else {
                                alert(`Course status updated to ${badgeText}`);
                            }
                        }
                    },
                    error: function (xhr) {
                        // Revert the dropdown to its previous value
                        const previousValue = $(this).data('value');
                        $(this).val(previousValue);

                        // Show error message
                        if (window.Notyf) {
                            new Notyf().error('Failed to update course status');
                        } else {
                            alert('Failed to update course status');
                        }
                    }
                });
            });
        });
    </script>
@endpush
