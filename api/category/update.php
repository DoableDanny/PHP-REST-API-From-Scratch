<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

  include_once "../../config/Database.php";
  include_once "../../models/Category.php";

  // Connect to db
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $category = new Category($db);

  // Get data
  $data = json_decode(file_get_contents("php://input"));

  $category->id = $data->id;
  $category->name = $data->name;

  $category->update();

  if($category->update()) {
    echo json_encode(
      array('message' => 'Category Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Category Not Updated')
    );
  }