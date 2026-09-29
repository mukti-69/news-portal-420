$("#advanced-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 2
        },
        password: {
            required: true,
            // minlength: 5
        },
        password_confirmation: {
            required: true,
            // minlength: 5,
            equalTo: "#password"
        },
        email: {
            required: true,
            email: true
        },
        agree: "required"
    },
    messages: {
        name: {
            required: "আপনার নাম লিখুন",
            minlength: "নাম কমপক্ষে ২ অক্ষরের হতে হবে"
        },
        password: {
            required: "পাসওয়ার্ড লিখুন",
            // minlength: "পাসওয়ার্ড কমপক্ষে ৫ অক্ষরের হতে হবে"
        },
        password_confirmation: {
            required: "পাসওয়ার্ড আবার লিখুন",
            // minlength: "পাসওয়ার্ড কমপক্ষে ৫ অক্ষরের হতে হবে",
            equalTo: "পাসওয়ার্ড দুটি মেলেনি"
        },
        email: {
            required: "আপনার ইমেইল লিখুন",
            email: "ইমেইল ঠিকানাটি সঠিক নয়",
        },
        agree: "নিয়ম ও শর্তাবলীতে টিক দিন"
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
        error.addClass("help-block");

        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else if (element.prop("type") === "checkbox") {
            error.insertAfter(document.getElementById('agree-label'));
        } else {
            error.insertAfter(element);
        }
    },

    highlight: function (element, errorClass, validClass) {
        $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
    }
});
