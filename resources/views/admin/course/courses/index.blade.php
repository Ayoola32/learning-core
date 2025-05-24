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



    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Provide Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="feedbackForm">
                        <div class="mb-3">
                            <label for="feedbackText" class="form-label">Feedback (Required)</label>
                            <textarea class="form-control" id="feedbackText" name="feedback" rows="4" required placeholder="Enter your feedback here..."></textarea>
                        </div>
                        <input type="hidden" id="courseId" name="course_id">
                        <input type="hidden" id="newStatus" name="new_status">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitFeedback">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="module">
        $(document).ready(function () {
            let currentDropdown = null;

            // Handle approval status change
            $(document).on('change', '.is_approved-select', function () {
                currentDropdown = $(this);
                const courseId = $(this).data('id');
                const newStatus = $(this).val();
                const previousValue = $(this).data('value');

                // Show modal for 'rejected' or 'approved' statuses
                if (newStatus === 'rejected' || newStatus === 'approved') {
                    $('#courseId').val(courseId);
                    $('#newStatus').val(newStatus);
                    $('#feedbackModal').modal('show');
                } else {
                    // For 'pending', update directly without feedback
                    updateCourseStatus(courseId, newStatus, null, currentDropdown, previousValue);
                }
            });

            // Handle modal submission
            $('#submitFeedback').on('click', function () {
                const feedback = $('#feedbackText').val().trim();
                const courseId = $('#courseId').val();
                const newStatus = $('#newStatus').val();
                const previousValue = currentDropdown.data('value');

                // Validate feedback
                if (!feedback) {
                    if (window.Notyf) {
                        new Notyf().error('Feedback is required');
                    } else {
                        alert('Feedback is required');
                    }
                    return;
                }

                // Close modal and update status with feedback
                $('#feedbackModal').modal('hide');
                updateCourseStatus(courseId, newStatus, feedback, currentDropdown, previousValue);

                // Clear the form
                $('#feedbackForm')[0].reset();
            });

            // Handle modal close without submission (revert dropdown)
            $('#feedbackModal').on('hidden.bs.modal', function () {
                if (currentDropdown) {
                    const previousValue = currentDropdown.data('value');
                    currentDropdown.val(previousValue);
                }
            });

            function updateCourseStatus(courseId, newStatus, feedback, dropdown, previousValue) {
                const row = dropdown.closest('tr');
                const statusCell = row.find('td').eq(3); // Status column (index 3, zero-based)

                $.ajax({
                    url: `/admin/courses/is_approved/${courseId}`,
                    type: 'POST',
                    data: {
                        is_approved: newStatus,
                        feedback: feedback,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            // Update the dropdown's data-value
                            dropdown.data('value', newStatus);

                            // Update the status badge in the DataTable
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
                        dropdown.val(previousValue);

                        // Show error message
                        if (window.Notyf) {
                            new Notyf().error('Failed to update course status');
                        } else {
                            alert('Failed to update course status');
                        }
                    }
                });
            }
        });
    </script>
@endpush
