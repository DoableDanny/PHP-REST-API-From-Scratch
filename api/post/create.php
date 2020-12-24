<?php

// Headers
header('Access-Control-Allow-Origin *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);