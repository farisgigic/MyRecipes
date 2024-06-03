let regs = []; // gdje spasavamo sva logovanja


$("#registerForm1").validate({
    rules: {
        "first_name": {
            required: true,

        },
        "last_name": {
            required: true
        },
        "email": {
            required: true,
            email: true
        },
        "password": {
            required: true
        }
    },
    messages: {
        "first_name": {
            required: "Please enter your name !",

        },
        "last_name": {
            required: "Please enter you surname !"
        },
        "email": {
            required: "Please enter your email !",
        },
        "password": {
            required: "Type correct password !"
        }
    },
    submitHandler: function (form, event) {
        event.preventDefault();
        blockUi("body");
        let register = serializeForm(form);
        //console.log(JSON.stringify(register));
        regs.push(register);


        $.post("http://localhost/Web%20Programming/backend/users/add", register, function () {

            $("#registerForm1")[0].reset();

            toastr.success("You have registered to our site ! ");

        }).fail(function (xhr, status, error) {
            console.log(xhr.responseText);

            toastr.error("Error ocured while adding recipe. ");
            // unblockUi("body");
        })
        //console.log("REGISTERS = ", regs);
        $("#registerForm1")[0].reset();
        unblockUi("body");


    }

});
blockUi = (element) => {
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

unblockUi = (element) => {
    $(element).unblock({});
}
serializeForm = (form) => {
    let jsonResult = {};
    //console.log($(form).serializeArray());
    //serializeArray() reutrns an array of: name: [name of filed], value: [value of filed] for each field in the form
    $.each($(form).serializeArray(), function () {
        jsonResult[this.name] = this.value;
    });
    return jsonResult;
}