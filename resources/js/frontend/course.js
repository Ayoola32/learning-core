const base_url = $('meta[name="base_url"]').attr('content');
const basic_info_url = base_url + '/instructor/courses';

$('.basic_info_form').on('submit', function (e) {
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
            console.log(xhr.responseText); // Log errors for debugging
        }
    });
});