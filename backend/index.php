<?php

require "vendor/autoload.php";


//require "rest/routes/middleware_routes.php";

require "rest/routes/recipes_routes.php";
require "rest/routes/user_routes.php";


require "rest/routes/auth_routes.php"; // for JWT 



Flight::start();