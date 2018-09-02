<?php 


if( !defined('ROOT') )die("Access Denied!");

function getPosts(){
	$posts = getDataArray("posts",false,false,"where status=1 and suspended=0");
	if( $posts && is_array($posts) )
		return $posts;
	return false;
}

function getPostById($id){
	$posts = getDataArray("posts",false,false,"where status=1 and id".$id);
	if( $posts && is_array($posts) )
		return $posts;
	return false;
}

function insertNewPost($post){
	// print_r($cat);
	// exit();
	if(insertData($post,"id","posts"))
		return true;
	return false;
}

function deletePost($post){
	$post['status'] = '0';
	if( updateObj($post,"id","posts") )return true;
	return false;
}
	
function updatePost( $post ){
	if( updateObj( $post,"id","posts" ) )return true;
	return false;
}


function getPostFor($pid){
	$posts = getDataArray("posts",false,false,"inner join users on posts.userId=users.id where posts.status=1 and posts.suspended=0 and posts.pid=".$pid);
	if( $posts && is_array($posts) )
		return $posts;
	return false;
}

?>