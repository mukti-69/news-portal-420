$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.input-group').addClass('has-error').removeClass("has-success");
    },
    unhighlight: function(element) {
        $(element).closest('.input-group').removeClass('has-error').addClass("has-success");
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$( "#form" ).validate( {
    rules: {
        old_password: {
            required: true,
            minlength: 5
        },
        password: {
            required: true,
            minlength: 5
        },
        confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#password"
        }
    },
    messages: {
        old_password: {
                required: "পুরনো পাসওয়ার্ড লিখুন",
                minlength: "পুরনো পাসওয়ার্ড কমপক্ষে ৫ অক্ষরের হতে হবে"
        },
        password: {
                required: "পাসওয়ার্ড লিখুন",
                minlength: "পাসওয়ার্ড কমপক্ষে ৫ অক্ষরের হতে হবে"
        },
        confirm_password: {
                required: "পাসওয়ার্ড আবার লিখুন",
                minlength: "পাসওয়ার্ড কমপক্ষে ৫ অক্ষরের হতে হবে",
                equalTo: "পাসওয়ার্ড দুটি মেলেনি"
        }
    }
} );
