<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once "../../config/Database.php";
include_once "../../models/Category.php";

// Connect to db
$database = new Database();
$db = $database->connect();

// Instantiate new Category object
$category = new Category($db);

// Get data
$data = json_decode(file_get_contents('php://input'));

$category->id = $data->id;

// Delete category
if($category->delete()) {
  echo json_encode(
    array('message' => 'Category Deleted')
  );
} else {
  echo json_encode(
    array('message' => 'Category Not Deleted')
  );
}