

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
        if (respon.reload) {
            window.location.reload();
        }

         

        },
        error: function (e) {
            loading.hide();
        }
    });
}));





	$().ready(function() {
		// validate the comment form when it is submitted
		$("#commentForm").validate();

        

		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
				topic: {
					required: "#newsletter:checked",
					minlength: 2
				},
				agree: "required"
			},
			messages: {
				firstname: "Please enter your firstname",
				lastname: "Please enter your lastname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				agree: "Please accept our policy",
				topic: "Please select at least 2 topics"
			}
		});

  });
  