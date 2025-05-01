const base_url = $('meta[name="base_url"]').attr('content');
const basic_info_url = base_url + '/instructor/courses';
const more_info_url = base_url + '/instructor/courses';

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


// More Info Form Submission
$(document).on('submit', '.more_info_form', function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    let courseId = $(this).find('input[name="id"]').val();
    console.log('Course ID:', courseId); // Debug

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
        error: function (xhr, status, error) {
            console.log(xhr.responseText); 
        }
    });
});