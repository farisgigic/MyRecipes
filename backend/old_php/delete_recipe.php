<?php

require_once __DIR__ . "/rest/services/RecipesService.class.php";

$recipe_id = $_REQUEST['id'];


$recipe_service = new RecipesService();

$recipe_service->delete_recipe($recipe_id);



