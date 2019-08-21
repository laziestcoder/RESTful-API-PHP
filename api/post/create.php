<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Post.php');

//Instantiate DB & connection
$database = new Database();
$db = $database->connect();

//Instantiate Post Object
$post = new Post($db);  // $db will pass through Post() to Post class __construct()

//Get raw posted data
$data = json_decode(file_get_contents('php://input'));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Create Post
if($post->create()){
    echo json_encode(
        array(
            'message' => 'Post Created',
        )
    );
}else{
    echo json_encode(
        array(
            'message' => 'Post Not Created',
        )
    );

}

?>