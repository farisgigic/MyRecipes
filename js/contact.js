$(document).ready(function() {
    let contacts = [];

    $("#contactForm").validate({
        rules: {
            "message": {
                required: true
            },
            "name": {
                required: true
            },
            "email": {
                required: true,
                email: true
            },
            "subject": {
                required: true
            }
        },
        messages: {
            "message": {
                required: "If you want to contact us, please let us know what you are interested in"
            },
            "name": {
                required: "Please enter your name !"
            },
            "email": {
                required: "Please enter your email !"
            },
            "subject": {
                required: "Tell us what type of subject you are asking for !"
            }
        },
        submitHandler: function(form, event) {
            event.preventDefault();
            blockUi("body");
            let contact = serializeForm(form);
            console.log(JSON.stringify(contact));
            contacts.push(contact);
            console.log("CONTACTS ARE : ", contacts);
            $("#contactForm")[0].reset();
            unblockUi("body");

        }

    });

    function blockUi(element) {
        $(element).block({
            message: '<div class="spinner-border text-primary" role="status"></div>',
            css: {
                backgroundColor: "transparent",
                border: "0"
            },
            overlayCSS: {
                backgroundColor: "#000000",
                opacity: 0.25
            }
        });
    }

    function unblockUi(element) {
        $(element).unblock({});
    }

    function serializeForm(form) {
        let jsonResult = {};
        $.each($(form).serializeArray(), function() {
            jsonResult[this.name] = this.value;
        });
        return jsonResult;
    }
});
