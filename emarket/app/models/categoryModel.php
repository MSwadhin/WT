<?php 


if( !defined('ROOT') )die("Access Denied!");

function getCats(){
	$cats = getDataArray("categories",false,false,"where status=1");
	if( $cats && is_array($cats) )
		return $cats;
	return false;
}


function getSubCats(){
	$cats = getDataArray("categories",false,false,"where status=1");
	if( $cats && is_array($cats) )
		return $cats;
	return false;
}

// function getSubCatsOf($id){
// 	$cats = getDataArray("categories",false,false,"where status=1 and parent=".$id);
// 	if( $cats && is_array($cats) )
// 		return $cats;
// 	return false;
// }





function insertNewCat($cat){
	// print_r($cat);
	// exit();
	if(insertData($cat,"id","categories"))
		return true;
	return false;
}

function deleteCat($cat){
	$cat['status'] = '0';
	if( updateObj($cat,"id","categories") )return true;
	return false;
}
	
function updateCat( $cat ){
	if( updateObj( $cat,"id","categories" ) )return true;
	return false;
}


function getCategory( $id ){
	$cat = getDataArray("categories",false,false,"where id=".$id);
	if( $cat && is_array($cat) )return $cat[0];
	return false;
}

?>