<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Connect to db
  $database = new Database();
  $db = $database->connect();

  // Instantiate categories object
  $category = new Category($db);

  // Get id
  $category->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get a category
  $category->read_single();

  // Create array
  $cat_array = array(
    'id' => $category->id,
    'name' => $category->name
  );

  // Print out JSON
  print_r(json_encode($cat_array));