let recs = []; // gdje spasavamo sva logovanja


$("#addRecipeForm").validate({
    rules: {
        "name": {
            required: true,

        },
        "time_taken": {
            required: true
        },
        "category": {
            required: true
        },
        "user_id": {
            required: true
        }
    },
    messages: {
        "name": {
            required: "Please enter name of the recipe !",

        },
        "time_taken": {
            required: "Enter time taken for this recipe !"
        },
        "category": {
            required: "Enter category for this recipe !",
        },
        "user_id": {
            required: "Tell us your ID !"
        }
    },
    submitHandler: function (form, event) {


        event.preventDefault();

        //blockUi("body");
        let recipe = serializeForm(form);
        //console.log(JSON.stringify(register));
        recs.push(recipe);
        // console.log("RECIPES = ", recs);

        // kada koristimo rute u ovaj link ubacujemo ime Service-a koji koristimo, u ovom slucaju koristimo RecipesService.class.php, tj njen objekat
        // $.post("http://localhost/Web%20Programming/backend/recipes/add", recipe, function (data) {

        //     $("#addRecipeForm")[0].reset();
        //     toastr.success("You have successfully added a recipe !");

        //     //unblockUi("body");

        // }).fail(function (xhr, status, error) {
        //     console.log(xhr.responseText);

        //     toastr.error("Error ocured while adding recipe! ");
        //     // unblockUi("body");
        // })
        // $("#addRecipeForm")[0].reset();

        // RestClient.post("http://localhost/Web%20Programming/backend/recipes/add", recipe, function (data) {
        //     $("#addRecipeForm")[0].reset();
        //     toastr.success("You have successfully added a recipe");
        // })


        //unblockUi("body");


    }

    // $.post("add_recipe.php", recipe, function (data) {
    //     $("#recipeForm")[0].reset();
    //     unblockUi("body");
    // }).fail(function (xhr, status, error) {
    //     console.log(xhr.responseText);
    //     alert("Error ocured while adding recipe. ");
    //     // unblockUi("body");
    // })


    // ili gornji kod ili donji
    // ispitati koji je tacan path za dobijanje add_recipe.php


    // $.post("http://localhost/Web%20Programming/backend/add_recipe.php", recipe, function (data) {
    //     $("#recipeForm")[0].reset();
    //     //unblockUi("body");
    // }).fail(function (xhr, status, error) {
    //     console.error(xhr.responseText);
    //     alert("Error occured while adding recipe. ");
    //     //unblockUi("body");
    // })

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