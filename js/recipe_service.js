var RecipeService = {
    delete_recipe: function ($id) {
        //alert("Delete me !");
        RestClient.delete(
            "recipes/delete/" + $id, {}, function (data) {

                toastr.success("Recipe deleted");
                console.log($id);
            }
        )
    },


};