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

//Post query
$result = $post->read();

//Get row count
$num = $result->rowCount();

// check if any posts
if($num > 0 ){
    //post array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name,
        );

        //Push to 'data'
        //array_push($posts_arr, $post_item);
        array_push($posts_arr['data'], $post_item);

    }

    //turn to JSON and output
    echo json_encode($posts_arr);

}else{

    //No Posts
    echo json_encode(
        array('message' => 'No Post Found')
    );
}


?>