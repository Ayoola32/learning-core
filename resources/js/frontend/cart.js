// Initialize Notyf
const notyf = new Notyf({
    duration: 7000, 
    position: { x: 'right', y: 'bottom' },
    dismissible: true 
});


// const base url
const csrf_token = $('meta[name="csrf-token"]').attr('content');
const base_url = $('meta[name="base_url"]').attr('content');
const cart_url = base_url + '/cart';
const cart_url_add = base_url + '/cart/add';



// Function to add a course to the cart
function addToCart(courseId) {
    $.ajax({
        url: cart_url_add + '/'+ courseId,
        type: 'POST',
        data: {
            _token: csrf_token,
            courseId: courseId
        },
        beforeSend: function() {
            // Optionally, show a loading spinner or disable the button
        },
        success: function(response) {
           notyf.success(response.message);
        },
        error: function(xhr, status, error) {
            let errorMessage = xhr.responseJSON;
            notyf.error(errorMessage);
        }
    });
}

//On Dom load, set up event listeners for add to cart buttons
$('.add_to_cart').on('click', function(event) {
    event.preventDefault();
    const userId = $(this).data('user-id');
    const courseId = $(this).data('course-id');
    addToCart(courseId);
})




// Function to remove a course from the cart
function removeFromCart(courseId) {
    $.ajax({
        url: cart_url + '/remove/' + courseId,
        type: 'DELETE',
        data: {
            _token: csrf_token,
            courseId: courseId
        },
        beforeSend: function() {
            // Optionally, show a loading spinner or disable the button
        },
        success: function(response) {
            notyf.success(response.message);
            location.reload(); 

        },
        error: function(xhr, status, error) {
            let errorMessage = xhr.responseJSON?.message || 'An error occurred';
            notyf.error(errorMessage);
        }

    });
}
// On Dom load, set up event listeners for remove from cart buttons
$('.remove_from_cart').on('click', function(event) {
    event.preventDefault();
    const courseId = $(this).data('course-id');
    removeFromCart(courseId);
});

