<?php
require_once __DIR__ . "/../services/AuthService.class.php";

use Firebase\JWT\JWT; // for creating JWT
use Firebase\JWT\Key; // for creating key and for decoding JWT that is got in inspect as Auth


Flight::set("auth_service", new AuthService());

Flight::group("/auth", function () {
    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"auth"},
     *      summary="Login to system using email and password",
     *      @OA\Response(
     *           response=200,
     *           description="Recipe data and JWT"
     *      ),
     *      @OA\RequestBody(
     *          description="Credentails",
     *          @OA\JsonContent(
     *              required={"email", "password"},
     *             
     *              @OA\Property(property="email", type="string", example="example@example.com", description="Your email"),
     *              @OA\Property(property="password", type="string", example="somepassword", description="Your password"),
     *          )
     *      )
     * )
     */
    Flight::route("POST /login", function () {

        $payload = Flight::request()->data->getData();

        $user = Flight::get("auth_service")->get_user_by_email($payload["email"]);

        if (!$user || !password_verify($payload["password"], $user["password"]))
            Flight::halt(500, "Invalid username or password");

        unset($user["password"]);

        //Flight::json($user);
        $jwt_payload = [
            "User" => $user,
            "iat" => time(),
            "exp" => time() + (60 * 60 * 24) // valid for day tj. vrijeme za koje token traje, nakon tog vremena u swaggeru iskace exception, moze se mijenajti
        ];

        $token = JWT::encode(
            $jwt_payload,
            JWT_SECRET,
            "HS256" // algoritam koji koristimo 
        );

        Flight::json(
            array_merge($user, ["token" => $token])
        );

    });

    /**
     * @OA\Post(
     *      path="/auth/logout",
     *      tags={"auth"},
     *      summary="Logout from the system",
     *      security = {
     *          {"ApiKey" : {}}
     *          },
     *      @OA\Response(
     *           response=200,
     *           description="Success response or exception if unable to verify JWT"
     *      ),
     *      
     * )
     */
    Flight::route("POST /logout", function () {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if (!$token)
                Flight::halt(401, "Missing authentication header");

            $decoded_token = JWT::decode($token, new Key(JWT_SECRET, "HS256"));

            Flight::json([
                "jwt_decoded" => $decoded_token,
                "User" => $decoded_token->user
            ]);
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    });
});
