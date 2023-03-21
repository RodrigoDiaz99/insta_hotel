function swal_success_redirect(message, redirect) {
    swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: message,
        confirmButtonText: 'Aceptar',
        focusConfirm:true
    }).then(function () {
        location.href = redirect

    })
}

function swal_success(message) {
    swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: message,
        confirmButtonText: 'Aceptar',
        focusConfirm:true
    })
}

function swal_error(message, redirect) {
    swal.fire({
        icon: 'error',
        title: 'Error',
        text: message,
        confirmButtonText: 'Aceptar',
        focusConfirm:true
    })
}

function validate(response) {
    $.each(response.responseJSON.errors, function (field_name, error) {
        var field_class = '.' + field_name + '_error';
        if (!$(document).find(field_class).length) {
            $(document).find('[name=' + field_name + ']').after('<span class="' + field_name + '_error error_validation text-strong text-danger">' + error + '</span>')
        }
    })

    setTimeout(() => {
        $('.error_validation').fadeOut("slow", function () {
            $(this).remove();
        });
    }, 2000);

}