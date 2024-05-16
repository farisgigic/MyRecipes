let logins = []; // gdje spasavamo sva logovanja

$("#showPasswordBtn").click(function() {
    var passwordField = $("#password");
    var passwordFieldType = passwordField.attr('type');
    if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        $(this).text('Hide Password');
    } else {
        passwordField.attr('type', 'password');
        $(this).text('Show');
    }
});
$("#loginForm").validate({
    rules:{
        "email" : {
            required : true,
            email : true
        },
        "password" : {
            required : true
        },
    },
    messages : {
        "email" : {
            required : "Please enter your email !",
            email : "Please enter a correct email !"
        },
        "password" : {
            required : "Please enter a password !"
        }
    },
    submitHandler: function(form, event){
        event.preventDefault();
        blockUi("body");
        let login = serializeForm(form);
        console.log(JSON.stringify(login));
        logins.push(login);
        console.log("LOGINS = ", logins);
        $("#loginForm")[0].reset();
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
    $.each($(form).serializeArray(), function() {
        jsonResult[this.name] = this.value;
    });
    return jsonResult;
}