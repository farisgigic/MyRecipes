<?php

require_once __DIR__ . "/../services/RecipesService.class.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set("recipe_service", new RecipesService());

Flight::group("/recipes", function () {

    /**
     * @OA\Get(
     *      path="/recipes/all",
     *      tags={"recipes"},
     *      summary="Get all patients",
     *      @OA\Response(
     *           response=200,
     *           description="Get all patients"
     *      )
     * )
     */
    Flight::route("GET /all", function () {
        // try {
        //     $token = Flight::request()->getHeader("Authentication");
        //     if (!$token)
        //         Flight::halt(401, "Missing authentication header");

        //     $decoded_token = JWT::decode($token, new Key(JWT_SECRET, "HS256"));

        //     Flight::json([
        //         "jwt_decoded" => $decoded_token,
        //         "User" => $decoded_token->user
        //     ]);
        // } catch (\Exception $e) {
        //     Flight::halt(401, $e->getMessage());
        // }
        $data = Flight::get("recipe_service")->get_all_recipes();
        Flight::json($data, 200);

    });
    /**
     * @OA\Get(
     *      path="/recipes/get/{id}",
     *      tags={"recipes"},
     *      summary="Get recipe by id",
     *      @OA\Response(
     *           response=200,
     *           description="Recipe data, or false if recipe does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="id", example="1", description="Recipe ID")
     * )
     */
    Flight::route('GET /get/@id', function ($id) {
        $recipe = Flight::get('recipe_service')->get_recipe_by_id($id);
        Flight::json($recipe);
    });



    /**
     * @OA\Delete(
     *      path="/recipes/recipes/delete/{id}",
     *      tags={"recipes"},
     *      summary="Delete recipe by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted recipe data with provided id "
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="id", example="1", description="Recipe ID")

     * )
     */


    Flight::route("DELETE /recipes/delete/@id", function ($id) {
        // $recipe_id = $_REQUEST['id'];

        Flight::get("recipe_service")->delete_recipe($id);
        Flight::json(["message" => "You have successfully deleted the recipe !"], 200);


        // $recipe_service = new RecipesService();

        // $recipe_service->delete_recipe($id);

    });

    /**
     * @OA\Post(
     *      path="/recipes/add",
     *      tags={"recipes"},
     *      summary="Add recipe data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Recipe data, or exception if recipe is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Recipe data payload",
     *          @OA\JsonContent(
     *              required={"name", "time_taken", "category", "user_id"},
     *              @OA\Property(property="id", type="string", example="1", description="Recipe ID"),
     *              @OA\Property(property="name", type="string", example="Some name", description="Recipe's name"),
     *              @OA\Property(property="time_taken", type="number", example="Some time", description="Recipe's time "),
     *              @OA\Property(property="category", type="string", example="Some name", description="Recipe's category"),
     *              @OA\Property(property="user_id", type="string", example="Some id", description="User's id"),
     *          )
     *      )
     * )
     */
    Flight::route("POST /recipes/add", function () {
        //$payload = $_REQUEST;
        $payload = Flight::request()->data->getData();

        //$recipe_service = new RecipesService();

        $recipe = Flight::get("recipe_service")->add_recipe($payload);

        //echo json_encode(["message" => "You have successfully added", "data" => $recipe, "payload" => $payload]);
        Flight::json(["message" => "You have successfully added", "data" => $recipe, "payload" => $payload]);

        //$recipe_service->add_recipe([]); 
        // base and dummy parameter given to function add_recipe(), to do something bigger we
        // need to give $payload as a parameter which is $_REQUEST from RecipesService.class.php
    });


});



Flight::route("GET /recipes", function () {

    $payload = Flight::request()->query;

    // Check if the expected parameters are present and set default values if not
    $start = isset($payload['start']) ? (int) $payload['start'] : 0;
    $search = isset($payload['search']['value']) ? $payload['search']['value'] : '';
    $length = isset($payload['length']) ? (int) $payload['length'] : 20;
    $order_column = isset($payload['order'][0]['column']) ? $payload['order'][0]['column'] : 'id';
    $order_direction = isset($payload['order'][0]['dir']) ? $payload['order'][0]['dir'] : 'desc';

    $params = [
        'start' => $start,
        'search' => $search,
        'limit' => $length,
        'order_column' => $order_column,
        'order_direction' => $order_direction
    ];

    $recipe_service = Flight::get("recipe_service");
    $data = $recipe_service->get_recipes_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

    // Filter out unnecessary fields
    $filtered_data = array_map(function ($item) {
        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'time_taken' => $item['time_taken'],
            'category' => $item['category'],
            'user_id' => $item['user_id'],
            // 'action' => $item['action']
        ];
    }, $data['data']);

    // Return JSON response with only the desired fields
    Flight::json(['data' => $filtered_data], 200);

});

Flight::route("POST /recipes/add", function () {
    //$payload = $_REQUEST;
    $payload = Flight::request()->data->getData();

    //$recipe_service = new RecipesService();

    $recipe = Flight::get("recipe_service")->add_recipe($payload);

    //echo json_encode(["message" => "You have successfully added", "data" => $recipe, "payload" => $payload]);
    Flight::json(["message" => "You have successfully added", "data" => $recipe, "payload" => $payload]);

    //$recipe_service->add_recipe([]); 
    // base and dummy parameter given to function add_recipe(), to do something bigger we
    // need to give $payload as a parameter which is $_REQUEST from RecipesService.class.php
});

Flight::route("DELETE /recipes/delete/@id", function ($id) {
    // $recipe_id = $_REQUEST['id'];

    Flight::get("recipe_service")->delete_recipe($id);
    Flight::json(["message" => "You have successfully deleted the recipe !"], 200);


    // $recipe_service = new RecipesService();

    // $recipe_service->delete_recipe($id);

});







