var RecipeService = {
    reload_recipes_datatable: function () {
        Utils.get_datatable(
            "tbl_recipes", "http://localhost/Web%20Programming/backend/get_recipes.php", [
            { data: "name" },
            { data: "time_taken" },
            { data: "category" },
            { data: "user_id" },
        ]
        );
    },
};