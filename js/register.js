let registers = []; // gdje spasavamo sva logovanja

$("#registerForm").validate({
    rules:{
        "name":{
            required : true
        },
        "surname":{
            required : true
        },
        "email" : {
            required : true,
            email : true
        },
        "password" : {
            required : true
        },
    },
    messages : {
        "name" : {
            required : "Please let us know your name."
        },
        "surname" : {
            required : "Please let us know your surname."
        },
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
        registers.push(login);
        console.log("REGISTERS = ", registers);
        $("#registerForm")[0].reset();
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