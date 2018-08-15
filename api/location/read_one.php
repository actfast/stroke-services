<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/location.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$location = new Location($db);

// set ID property of product to be edited
$location->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$location->readOne();

// create array
$location_arr = array(
    "id" => $location->id,
    "name" => $location->name,
    "description" => $location->description
);

// make it json format
print_r(json_encode($location_arr));
?>