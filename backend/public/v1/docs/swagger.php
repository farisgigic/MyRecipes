<?php

require __DIR__ . '/../../../vendor/autoload.php';
// require __DIR__ . './../../../vendor/autoload.php';

define('BASE_URL', 'http://localhost/Web%20Programming/backend');


error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../../../rest/routes/', './']);
// $openapi = \OpenApi\Util::finder(['../../../rest/routes', './'], NULL, '*.php');
// $openapi = \OpenApi\scan(['../../../rest/routes', './'], ['pattern' => '*.php']);

header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
