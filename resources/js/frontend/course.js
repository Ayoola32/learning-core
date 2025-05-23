// Initialize Notyf
const notyf = new Notyf({
    duration: 7000, 
    position: { x: 'right', y: 'bottom' },
    dismissible: true 
});


const base_url = $('meta[name="base_url"]').attr('content');
const courses_url = base_url + '/instructor/courses';

// Course Steps Navigation
$(document).on('click', '.course-tab', function (e) {
    e.preventDefault();
    let step = $(this).data('step');
    let courseId = window.courseId || null;
    let url = courseId ? courses_url + '/' + courseId + '/edit?step=' + step : courses_url + '/create?step=' + step;
    window.location.href = url;
});




// Store New Course - Basic Info (Step 1)
$(document).on('submit', '.basic_info_form', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: courses_url,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            // Optional: Add a loading state
        },
        success: function (response) {
            if (response.status === 'success') {
                window.location.href = response.redirect;
            }
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;

            if (errors) {
                $.each(errors, function (key, value) {
                    notyf.error(value[0]);  
                });
            }
        }
    });
});

// Update Course Basic Info - Step 1
$(document).on('submit', '.basic_info_update_form', function (e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);
    formData.append('_method', 'PUT'); 

    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            // Optional: Add a loading state
        },
        success: function (response) {
            if (response.status === 'success') {
                window.location.href = response.redirect;
            }
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;

            if (errors) {
                $.each(errors, function (key, value) {
                    notyf.error(value[0]);  
                });
            }
        }
    });
});

// Update More Info Form - Step 2
$(document).on('submit', '.more_info_form', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append('_method', 'PUT');
    let courseId = window.courseId;
    $.ajax({
        type: 'POST',
        url: courses_url + '/' + courseId,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            // Optional: Add a loading state
        },
        success: function (response) {
            if (response.status === 'success') {
                window.location.href = response.redirect;
            }
        },
        error: function (xhr, status, error) {
            let errors = xhr.responseJSON.errors;

            if (errors) {
                $.each(errors, function (key, value) {
                    notyf.error(value[0]);  
                });
            }
        }
    });
});

// Update Finish Course Form - Step 4
$(document).on('submit', '.finish_course_form', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('_method', 'PUT');
        let courseId = window.courseId;
        $.ajax({
            type: 'POST',
            url: courses_url + '/' + courseId,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // Optional: Add a loading state
            },      
            success: function (response) {
                if (response.status === 'success') {
                    let successMessage;
                    if (response.course_status === 'active') {
                        successMessage = "You have successfully added a new course. It will be in review. " +
                            "Kindly wait for the admin to get back to you. You will receive a confirmation email if it has been approved or not. " +
                            "Also, you can edit your course within the next 3 hours, as you won’t be able to edit it while the admin is reviewing to avoid clashes.";
                    } else {
                        successMessage = "You have successfully added a new course. It has been saved as a draft or inactive and is not yet in review.";
                    }
                    $('#successMessage').text(successMessage);

                    // Show the success modal
                    $('#successModal').modal('show');

                    // Redirect after modal is closed
                    $('#successModal').on('hidden.bs.modal', function () {
                        window.location.href = response.redirect;
                    });
                }
            },
            error: function (xhr, status, error) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function (key, value) {
                        notyf.error(value[0]);  
                    });
                }
            }
        });
    });

// Update Active Tab on Page Load
$(document).ready(function () {
    let step = new URLSearchParams(window.location.search).get('step') || '1';
    $('.course-tab').removeClass('active');
    $('.course-tab[data-step="' + step + '"]').addClass('active');
});


// Initialize form state on page load for storage options
$(document).ready(function () {
    let storageValue = $('.storage').val();
    if (storageValue == 'upload') {
        $('.source_upload').removeClass('d-none');
        $('.source_link').addClass('d-none');
    } else if (storageValue == 'youtube' || storageValue == 'vimeo' || storageValue == 'external_link') {
        $('.source_link').removeClass('d-none');
        $('.source_upload').addClass('d-none');
    } else {
        $('.source_upload').addClass('d-none');
        $('.source_link').addClass('d-none');
    }
});

// Show/hide path input depending on the selected storage option
$('.storage').on('change', function () {
    let value = $(this).val();
    $('.source_input').val(''); // Clear inputs on change
    if (value == 'upload') {
        $('.source_upload').removeClass('d-none');
        $('.source_link').addClass('d-none');
    } else if (value == 'youtube' || value == 'vimeo' || value == 'external_link') {
        $('.source_link').removeClass('d-none');
        $('.source_upload').addClass('d-none');
    } else {
        $('.source_upload').addClass('d-none');
        $('.source_link').addClass('d-none');
    }
});


// Initialize File Manager
$('#lfm').filemanager('file');


// Loading spinner for modal
var loader = `
    <div class="modal-content text-center" style="padding: 20px; display:inline">
       <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
`;

// 
// 
// Modal for Course Chapter Create and Update
// 
// 

// Display modal for chapter creation
$('.dynamic-modal-btn').on('click', function (e) {
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    let courseId = $(this).data('id');

    $.ajax({
        url: `${base_url}/instructor/course-content/${courseId}/create-chapter`,
        type: 'GET',
        data: {},
        beforeSend: function () {
            // Optional: Add a loading state
            $('.dynamic-modal-content').html(loader);

        },
        success: function (data) {
            // Load the content into the modal
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            // Handle error
            console.log('Error:', error);
            $('.dynamic-modal-content').html('<div class="modal-content text-center" style="padding: 20px;">Error loading form. Please try again.</div>');
        }
    });
});


// Handle the chapter modal form submission (AJAX)
$(document).on('submit', '.dynamic-modal-content form', function (e) {
    e.preventDefault();

    const $form = $(this);
    const actionUrl = $form.attr('action');
    const formData = $form.serialize();

    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: formData,
        success: function (response) {
            if (response.status === 'success') {
                if (window.Notyf) {
                    new Notyf().success(response.message);
                } else {
                    alert(response.message);
                }
                $('#dynamic-modal').modal('hide');

                // Delay the redirect/reload
                setTimeout(function () {
                    if (response.redirect) {
                        window.location.href = response.redirect; 
                    } else {
                        window.location.reload(); 
                    }
                }, 2000); 
            }
        },
        error: function (xhr) {
            if (window.Notyf) {
                new Notyf().error("Something went wrong.");
            } else {
                alert("Error occurred.");
            }
        }
    });
});

// Display modal for chapter update
$('.dynamic-modal-chapter').on('click', function (e) {
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    let chapterId = $(this).data('chapter-id');
    let courseId = $(this).data('course-id');

    $.ajax({
        url: `${base_url}/instructor/course-content/${courseId}/edit-chapter/${chapterId}`,
        type: 'GET',
        data: {},
        beforeSend: function () {
            // Optional: Add a loading state
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            // Load the content into the modal
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            // Handle error
            console.log('Error:', error, 'Status:', status, 'Response:', xhr.responseText);
            $('.dynamic-modal-content').html('<div class="modal-content text-center" style="padding: 20px;">Error loading form. Please try again.</div>');        }
    });
}
);

// Handle the chapter modal form submission (AJAX) for update
$(document).on('submit', '.dynamic-modal-content chapter-update-form', function (e) {
    e.preventDefault();

    const $form = $(this);
    const actionUrl = $form.attr('action');
    const formData = $form.serialize();

    $.ajax({
        type: 'POST', 
        url: actionUrl,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                if (window.Notyf) {
                    new Notyf().success(response.message);
                } else {
                    alert(response.message);
                }
                $('#dynamic-modal').modal('hide');

                // Delay the redirect/reload
                setTimeout(function () {
                    if (response.redirect) {
                        window.location.href = response.redirect; 
                    } else {
                        window.location.reload(); 
                    }
                }, 2000);            
            }
        },
        error: function (xhr) {
            const errorMessage = xhr.responseJSON?.message || 'Something went wrong.';
            if (window.Notyf) {
                new Notyf().error(errorMessage);
            } else {
                alert(errorMessage);
            }
            console.log('Submission Error:', xhr.responseJSON);
        }
    });
});

// 
// 
// End Modal for Course Chapter Create and Update
// 
// 



// 
// 
// Handle the Lesson modal form display and submission CREATE & UPDATE
// 
// 

// Display modal for lesson creation
$('.add_lesson').on('click', function (e) {
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');

    $.ajax({
        url: `${base_url}/instructor/course-content/${courseId}/create-lesson/${chapterId}`,
        type: 'GET',
        data: {},
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            console.log('Error loading lesson form:', error, xhr.responseText);
            $('.dynamic-modal-content').html('<div class="modal-content text-center" style="padding: 20px;">Error loading form. Please try again.</div>');
        }
    });
});



// Initialize form state after modal is shown - Lesson Modal
$('#dynamic-modal').on('shown.bs.modal', function () {
    let storageValue = $('.storage-lesson').val();
    if (storageValue == 'upload') {
        $('.source_upload').removeClass('d-none');
        $('.source_link').addClass('d-none');
    } else if (storageValue == 'youtube' || storageValue == 'vimeo' || storageValue == 'external_link') {
        $('.source_link').removeClass('d-none');
        $('.source_upload').addClass('d-none');
    } else {
        $('.source_upload').addClass('d-none');
        $('.source_link').addClass('d-none');
    }

    // Initialize Laravel File Manager for dynamically loaded buttons
    if ($('#lfm').length) {
        $('#lfm').filemanager('file', {prefix: '/filemanager'});
    }
});

// Show/hide path input depending on the selected storage option - Lesson Modal
$(document).on('change', '.storage-lesson', function () {
    let value = $(this).val();
    $('.source_input').val(''); // Clear inputs on change
    if (value == 'upload') {
        $('.source_upload').removeClass('d-none');
        $('.source_link').addClass('d-none');
    } else if (value == 'youtube' || value == 'vimeo' || value == 'external_link') {
        $('.source_link').removeClass('d-none');
        $('.source_upload').addClass('d-none');
    } else {
        $('.source_upload').addClass('d-none');
        $('.source_link').addClass('d-none');
    }
});

// Display modql for lesson update
$('.edit-lesson').on('click', function (e) {
    e.preventDefault();
    $('#dynamic-modal').modal('show');
    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let lessonId = $(this).data('lesson-id');

    $.ajax({
        url: `${base_url}/instructor/course-content/${courseId}/edit-lesson/${chapterId}/${lessonId}`,
        type: 'GET',
        data: {},
        beforeSend: function () {
            $('.dynamic-modal-content').html(loader);
        },
        success: function (data) {
            $('.dynamic-modal-content').html(data);
        },
        error: function (xhr, status, error) {
            console.log('Error:', error, 'Status:', status, 'Response:', xhr.responseText);
            $('.dynamic-modal-content').html('<div class="modal-content text-center" style="padding: 20px;">Error loading form. Please try again.</div>');
        }
    });
});

// Handle the lesson modal form submission (AJAX) for Update
$(document).on('submit', '.dynamic-modal-content lesson-update-form', function (e) {
    e.preventDefault();

    const $form = $(this);
    const actionUrl = $form.attr('action');
    const formData = $form.serialize();

    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                if (window.Notyf) {
                    new Notyf().success(response.message);
                } else {
                    alert(response.message);
                }
                $('#dynamic-modal').modal('hide');

                // Delay the redirect/reload
                setTimeout(function () {
                    if (response.redirect) {
                        window.location.href = response.redirect; 
                    } else {
                        window.location.reload(); 
                    }
                }, 2000);            
            }
        },
        error: function (xhr) {
            const errorMessage = xhr.responseJSON?.message || 'Something went wrong.';
            if (window.Notyf) {
                new Notyf().error(errorMessage);
            } else {
                alert(errorMessage);
            }
            console.log('Submission Error:', xhr.responseJSON);
        }
    });
});

// 
// 
//  End Handle the Lesson modal form display and submission CREATE & UPDATE
// 
// 



//
//
// 
// Handle the delete chapeter and lesson
//
// 
// 

// Delete Chapter
$(document).on('click', '.delete-chapter', function (e) {
    e.preventDefault();
    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let url = `${base_url}/instructor/course-content/${courseId}/delete-chapter/${chapterId}`;
    
    Swal.fire({
        title: 'Are you sure?',
        text: `You won't be able to revert this!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                },
                success: function(response) {
                    if (response.status === 'error') {
                        Swal.fire({
                            title: "Error!",
                            text: response.message || "Cannot delete chapter, it may contain lessons.",
                            icon: "error"
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message,
                            icon: "success"
                        }).then(() => {
                            // Reload the page after 2 seconds to show the success message
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Delete Error:', error, 'Status:', status, 'Response:', xhr.responseText);
                    Swal.fire({
                        title: "Error!",
                        text: xhr.responseJSON?.message || "Something went wrong.",
                        icon: "error"
                    });
                }
            });
        }
    });
});

// delete lesson
$(document).on('click', '.delete-lesson', function (e) {
    e.preventDefault();
    let courseId = $(this).data('course-id');
    let chapterId = $(this).data('chapter-id');
    let lessonId = $(this).data('lesson-id');
    let url = `${base_url}/instructor/course-content/${courseId}/delete-lesson/${chapterId}/${lessonId}`;
    
    Swal.fire({
        title: 'Are you sure?',
        text: `You won't be able to revert this!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                },
                success: function(response) {
                    if (response.status === 'error') {
                        Swal.fire({
                            title: "Error!",
                            text: response.message || "Cannot delete lesson.",
                            icon: "error"
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: response.message,
                            icon: "success"
                        }).then(() => {
                            // Reload the page after 2 seconds to show the success message
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Delete Error:', error, 'Status:', status, 'Response:', xhr.responseText);
                    Swal.fire({
                        title: "Error!",
                        text: xhr.responseJSON?.message || "Something went wrong.",
                        icon: "error"
                    });
                }
            });
        }
    });
}
);

//
//
// 
// End of delete chapeter and lesson
//
// 
// 



// 
// 
// Handle Sortable for Chapter and Lesson
// 
// 
// 

$(document).ready(function () {
    if ($('.sortable_list li').length) {
        $('.sortable_list').each(function () {
            let $list = $(this);
            // Get chapterId from a parent element (e.g., the accordion header or a data attribute)
            let chapterId = $list.closest('.accordion-item').find('.edit-lesson').data('chapter-id');
            if (!chapterId) {
                console.error('Chapter ID not found for sortable list');
                return;
            }

            $list.sortable({
                handle: '.arrow', // Use the arrow link as the drag handle
                update: function (event, ui) {
                    let order = [];
                    $list.find('li').each(function (index) {
                        order.push({
                            id: $(this).data('lesson-id'),
                            order: index + 1 // Order starts from 1
                        });
                    });

                    // Send the new order to the server via AJAX
                    $.ajax({
                        url: `${base_url}/instructor/course-content/chapter/${chapterId}/update-lesson-order`,
                        type: 'POST',
                        data: {
                            order: order,
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function (response) {
                            if (response.status === 'success') {
                                if (window.Notyf) {
                                    new Notyf().success(response.message);
                                } else {
                                    alert(response.message);
                                }
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log('Order Update Error:', error, xhr.responseText);
                            if (window.Notyf) {
                                new Notyf().error('Failed to update lesson order.');
                            } else {
                                alert('Failed to update lesson order.');
                            }
                        }
                    });
                }
            }).disableSelection(); // Prevent text selection while dragging
        });
    }


    // Updated sortable chapter code
    $('.sort-chapters').on('click', function (e) {
        e.preventDefault();
        let courseId = $(this).data('course-id');
        $('#dynamic-modal').modal('show');

        $.ajax({
            url: `${base_url}/instructor/course-content/${courseId}/sort-chapters`,
            type: 'GET',
            beforeSend: function () {
                $('.dynamic-modal-content').html('<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>');
            },
            success: function (data) {
                $('.dynamic-modal-content').html(data);
                $('.chapter-sortable-list').sortable({
                    handle: '.arrow',
                    update: function (event, ui) {
                        let order = [];
                        $('.chapter-sortable-list li').each(function (index) {
                            order.push({
                                id: $(this).data('chapter-id'),
                                order: index + 1
                            });
                        });

                        $.ajax({
                            url: `${base_url}/instructor/course-content/${courseId}/update-chapter-order`,
                            type: 'POST',
                            data: {
                                order: order,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    if (window.Notyf) {
                                        new Notyf().success('Chapter has been sorted successfully');
                                    } else {
                                        alert('Chapter has been sorted successfully');
                                    }
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log('Order Update Error:', error, xhr.responseText);
                                if (window.Notyf) {
                                    new Notyf().error('Failed to update chapter order.');
                                } else {
                                    alert('Failed to update chapter order.');
                                }
                            }
                        });
                    }
                }).disableSelection();
            },
            error: function (xhr, status, error) {
                console.log('Modal Load Error:', error, xhr.responseText);
                $('.dynamic-modal-content').html('<div class="modal-content text-center" style="padding: 20px;">Error loading chapters. Please try again.</div>');
            }
        });
    });

    // Handle modal close to trigger page reload after 2 seconds
    $('#dynamic-modal').on('hidden.bs.modal', function () {
        setTimeout(function () {
            window.location.reload();
        }, 2000);
    });
});