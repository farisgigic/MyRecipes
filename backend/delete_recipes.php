<?php

require_once __DIR__ . "/rest/services/RecipesService.class.php";

$recipe_id = $_REQUEST["id"]; // passamo ga u url kada napisemo (?id = id) t
// to znaci gdje je taj id = id

if ($recipe_id == NULL || $recipe_id == "") {
    header("HTTP/1.1 500 Bad Reqest");
    die(json_encode(["error" => "Invalid recipe id"]));
}

$recipe_service = new RecipesService();

$recipe_service = get_product_by_id($recipe_id);

echo json_encode(["messsage" => "you have successfully deleted a recipe"]);