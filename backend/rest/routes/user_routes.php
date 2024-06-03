<?php

require_once __DIR__ . "/../services/UserService.class.php";


Flight::set("user_service", new UserService());

Flight::group("/users", function () {

    /**
     * @OA\Get(
     *      path="/users/all",
     *      tags={"users"},
     *      summary="Get all users",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all users in the databases"
     *      )
     * )
     */
    Flight::route('GET /all', function () {
        $data = Flight::get('user_service')->get_all_users();
        Flight::json($data, 200);
    });

    /**
     * @OA\Get(
     *      path="/users/get/{id}",
     *      tags={"users"},
     *      summary="Get user by id",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or false if user does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="id", example="1", description="User ID")
     * )
     */
    Flight::route('GET /get/@id', function ($id) {
        $user = Flight::get('user_service')->get_user_by_id($id);
        Flight::json($user);
    });

    /**
     * @OA\Delete(
     *      path="/users/users/delete/{id}",
     *      tags={"users"},
     *      summary="Delete user by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted user data with provided id "
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="id", example="1", description="User ID")

     * )
     */


    Flight::route("DELETE /users/delete/@id", function ($id) {
        // $recipe_id = $_REQUEST['id'];

        Flight::get("user_service")->delete_user_by_id($id);
        Flight::json(["message" => "You have successfully deleted the user !"], 200);


        // $recipe_service = new RecipesService();

        // $recipe_service->delete_recipe($id);

    });
    /**
     * @OA\Post(
     *      path="/users/add",
     *      tags={"users"},
     *      summary="Add user data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or exception if user is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="User data payload",
     *          @OA\JsonContent(
     *              required={"id", "first_name", "last_name", "email"},
     *              @OA\Property(property="id", type="string", example="Some name", description="User's first name"),
     *              @OA\Property(property="first_name", type="string", example="Some name", description="User's first name"),
     *              @OA\Property(property="last_name", type="string", example="Some name", description="User's last name"),
     *              @OA\Property(property="email", type="string", example="example@example.com", description="User's email"),
     *              @OA\Property(property="password", type="string", example="some_password", description="User's password"),
     *              
     *          )
     *      )
     * )
     */
    Flight::route("POST /add", function () {
        //$payload = $_REQUEST;
        $payload = Flight::request()->data->getData();

        //$recipe_service = new RecipesService();

        $user = Flight::get("user_service")->add_user($payload);

        //echo json_encode(["message" => "You have successfully added", "data" => $recipe, "payload" => $payload]);
        Flight::json(["message" => "You have successfully added", "data" => $user, "payload" => $payload]);

        //$recipe_service->add_recipe([]); 
        // base and dummy parameter given to function add_recipe(), to do something bigger we
        // need to give $payload as a parameter which is $_REQUEST from RecipesService.class.php
    });



});