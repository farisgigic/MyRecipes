<?php

require_once __DIR__ . "/rest/services/RecipesService.class.php";

// Check if the expected parameters are present and set default values if not
$start = isset($_REQUEST['start']) ? (int) $_REQUEST['start'] : 0;
$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
$length = isset($_REQUEST['length']) ? (int) $_REQUEST['length'] : 20;
$order_column = isset($_REQUEST['order']['name']) ? $_REQUEST['order']['name'] : 'id';
$order_direction = isset($_REQUEST['order']['dir']) ? $_REQUEST['order']['dir'] : 'desc';

$params = [
    'start' => $start,
    'search' => $search,
    'limit' => $length,
    'order_column' => $order_column,
    'order_direction' => $order_direction
];

$recipe_service = new RecipesService();

$data = $recipe_service->get_recipes_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

foreach ($data['data'] as $id => $recipe) {
    $data['data'][$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
        '<button type="button" class="btn btn-warning">Edit</button>' .
        '<button type="button" class="btn btn-danger">Delete</button>' .
        '</div>';
}
// Filter out unnecessary fields
$filtered_data = array_map(function ($item) {
    return [
        // 'action' => $item['action'],
        'name' => $item['name'],
        'time_taken' => $item['time_taken'],
        'category' => $item['category'],
        'user_id' => $item['user_id']
    ];
}, $data['data']);

// Return JSON response with only the desired fields
echo json_encode($filtered_data);
