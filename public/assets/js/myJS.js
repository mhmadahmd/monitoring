

$(document).on('submit', 'form.form-action', function (ev) {
  
    let form = $(this),
    url = form.attr('action');
    if (!form.valid) return false;
    $(this).prop('disabled', true);
    ev.stopPropagation();
    ev.preventDefault();
    let data = form.serializeArray();
    data.push({
        name: '_token',
        value: $('meta[name="csrf-token"]').attr('content'),
    });
    $.post(url, data, function (respon) {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        if (respon.status === 0) {
            Toast.fire({
                type: 'success',
                title: respon.message
            })
        }
        if (respon.status === 1) {
            Toast.fire({
                type: 'error',
                title: respon.message
            })
        }
        if (respon.reload) {
            window.location.reload();
        }
        if (respon.redirect) {
            setTimeout(function () {
                window.location.href = respon.redirect;
            }, 2000);
        }
    }, 'json');
});







//form with file
$(".form-file-action").on('submit', (function (e) {
    $(this).prop('disabled', true);
    e.stopPropagation();
    e.preventDefault();

    var form = $(this),
 
        formData = new FormData(this),
        url = form.attr('action'),
        loading = $('.hh-loading', form);

    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            loading.show();
        },
        success: function (respon) {
            if ($('.form-message', form).length) {
                $('.form-message', form).html(respon.message);
            }
            loading.hide();
            
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
          
        if (respon.status === 0) {
            Toast.fire({
                type: 'success',
                title: respon.message
            })
        }
        if (respon.status === 1) {
            Toast.fire({
                type: 'error',
                title: respon.message
            })
        }
        if (respon.redirect) {
            setTimeout(function () {
                window.location.href = respon.redirect;
            }, 2000);
        }
        if (respon.reload) {
            window.location.reload();
        }

         

        },
        error: function (e) {
            loading.hide();
        }
    });
}));


//delete ajax with swal

$('.confirmDelete').on('click', function () {
    var id = $(this).data('id');
    var action = $(this).data('action');
    console.log(id);
    swal({
        title: window.translation.deletemodal1,
        text: window.translation.deletemodal2,
        type: 'warning',
		icon: "warning",
		buttons: true,
		dangerMode: true,
        padding: '2em'
    }).then(function (result) {

        if (result == true) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: action + id,
                cache: false,
                contentType: false,
                processData: false,

                success: (data) => {
                        if (data['status'] == '1') {
                            swal(
                                window.translation.deleted,
                                window.translation.success,
                                'success'
                            )
                        }
                        if (data['reload']) {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                },
                error: function (data) {
                    console.log(data);
                }
            });

        }
    })
});


