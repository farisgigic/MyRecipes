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
    public function delete_recipe($recipe_id)
    {
        $this->$this->recipeDao->delete_recipe($recipe_id);
    }
    

}
?>