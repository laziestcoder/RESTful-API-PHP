<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Post.php');

//Instantiate DB & connection
$database = new Database();
$db = $database->connect();

//Instantiate Post Object
$post = new Post($db);  // $db will pass through Post() to Post class __construct()

//Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get Post
$post->read_single();

//Create Array
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => html_entity_decode($post->body),
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,
);

//Make JSON

print_r(json_encode($post_arr));



?>