const base_url = $('meta[name="base_url"]').attr('content');
const basic_info_url = base_url + '/instructor/courses';
const more_info_url = base_url + '/instructor/courses';

// Store New Course - Basic Info
$(document).on('submit', '.basic_info_form', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: basic_info_url,
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
            console.log(xhr.responseText); 
        }
    });
});


// Update Course Basic Info - Status Step 1
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
            console.log(xhr.responseText);
        }
    });
});


// Update More Info Form - Status Step 2
$(document).on('submit', '.more_info_form', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append('_method', 'PUT'); 
    $.ajax({
        type: 'POST',
        url: more_info_url + '/' + courseId, 
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
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
});

