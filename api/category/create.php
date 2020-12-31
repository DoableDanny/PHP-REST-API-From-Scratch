<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Method: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

  include_once "../../config/Database.php";
  include_once "../../models/Category.php";

  // Connect to db
  $database = new Database();
  $db = $database->connect();
  
  // Instantiate new Cateogry object
  $category = new Category($db);

  // Get post data
  $data = json_decode(file_get_contents('php://input'));

  $category->name = $data->name;

  if($category->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }