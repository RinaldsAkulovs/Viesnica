;(function ($) {
    $('#submit').on('click', function (e) {
        e.preventDefault();
        console.error('aaaa')
        submitForm();

    });

    $('#contactForm').submit(function (event) {
        event.preventDefault();
        submitForm();
        return false;
    });

    // if (window.location.hash) {
    //     var hash = window.location.hash;
    //     $(hash).modal('toggle');
    // }

// function to handle form submit
    function submitForm() {
        $.ajax({
            type: 'POST',
            url: 'rezervation_room.html',
            cache: false,
            data: $('form#contactForm').serialize(),
            success: function (response) {
                const keys = Object.keys(response);

                if (response.error) {
                    const fields = Object.keys(response[keys]);
                    fields.map(key => {
                        console.error(key)
                        $(`input[name="${key}"]`).addClass('is-invalid')
                    });
                    return;
                }

                if (response.success) {
                    $('input').val('').removeClass('is-invalid');
                    $('.error-box').html(response.success);
                    $('#contact-modal').modal('hide');
                }

            },
            error: function () {
                alert('Error');
            }
        });
    }
})(jQuery);