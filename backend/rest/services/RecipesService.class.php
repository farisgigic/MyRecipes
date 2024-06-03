<?php
require_once __DIR__ . '/../dao/RecipeDao.class.php';

class RecipesService
{

    private $recipeDao;

    public function __construct()
    {
        $this->recipeDao = new RecipeDao();
    }

    public function add_recipe($recipe)
    {
        // Call the add_recipe method in RecipeDao
        return $this->recipeDao->add_recipe($recipe);
    }
    public function get_recipes_paginated($offset, $limit, $search, $order_column, $order_direction)
    {
        $count = $this->recipeDao->count_recipes_paginated($search)["count"];
        $rows = $this->recipeDao->get_recipes_paginated($offset, $limit, $search, $order_column, $order_direction);


        return [
            'count' => $count,
            'data' => $rows
        ];

    }
    public function delete_recipe($id)
    {
        $this->recipeDao->delete_recipe($id);
    }
    public function get_all_recipes()
    {
        return $this->recipeDao->get_all_recipes();
    }

    public function get_recipe_by_id($id)
    {
        return $this->recipeDao->get_recipe_by_id($id);

    }
    public function edit_recipe($recipe)
    {
        $id = $recipe["id"];
        $this->recipeDao->edit_recipe($id, $recipe);
    }
}
?>