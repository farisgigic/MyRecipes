<?php
// require_once __DIR__ . "./../rest/services/RecipesService.class.php";
require_once __DIR__ . '/rest/services/RecipesService.class.php';

$payload = $_REQUEST;

// ERROR HANDLING 


// if ($payload["name"] == NULL || $payload["name"] == "") {
//       header("HTTP/1.1 500 Bad Request");
//      die(json_encode(["error" => "First name field missing"]));
// }


// NEBITNO NEPOTREBNO 

$recipe_service = new RecipesService();

//unset($payload["id"]); // nepotrebno, ali koristi se da se unseta payload 

$recipe = $recipe_service->add_recipe($payload);
echo json_encode(["message" => "You have successfully added", "data" => $recipe, "payload" => $payload]);

//$recipe_service->add_recipe([]); 
// base and dummy parameter given to function add_recipe(), to do something bigger we
// need to give $payload as a parameter which is $_REQUEST from RecipesService.class.php