$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error').removeClass("has-success");
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass("has-success");
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

$("#simple-form").validate();
$("#validate-form").validate();


$( "#advanced-form" ).validate( {
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
        agree: "required"
    },
    messages: {
        firstname: "অনুগ্রহ করে নাম লিখুন",
        lastname: "অনুগ্রহ করে পদবি লিখুন",
        username: {
                required: "ইউজারনেম আবশ্যক",
                minlength: "ইউজারনেম কমপক্ষে ২ অক্ষরের হতে হবে"
        },
        password: {
                required: "পাসওয়ার্ড লিখুন",
                minlength: "পাসওয়ার্ড কমপক্ষে ৫ অক্ষরের হতে হবে"
        },
        confirm_password: {
                required: "পাসওয়ার্ড আবার লিখুন",
                minlength: "পাসওয়ার্ড কমপক্ষে ৫ অক্ষরের হতে হবে",
                equalTo: "পাসওয়ার্ড দুটি মেলেনি"
        },
        email: "ইমেইল ঠিকানাটি সঠিক নয়",
        agree: "নিয়ম ও শর্তাবলীতে টিক দিন"
    },
    errorElement: "em",
    errorPlacement: function ( error, element ) {
        error.addClass( "help-block" );

        if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
        } else {
                error.insertAfter( element );
        }
    },
    highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
        $( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
    }
} );
