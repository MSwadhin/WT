<?php


if( !defined('ROOT') )die("Access Denied!!");

if( !isCurUserAdmin() ){
	die("Access Denied !!!");
}


if( !getModel("categoryModel") )die("Database Connection Error");

function add(){
	$cats = getCats();
	$data = array();
	$data['flag'] = 'new';
	$error = array(
		'name' => '',
		'parent' => ''
	);
	$value = array(
		'name' => '',
		'parent' => ''
	);
	$data['prevCats'] = $cats;
	if( $_SERVER['REQUEST_METHOD']=="POST" ){

		$cat = array();
		$name = validateNickName( "name" );
		$parent = validateNumber("parent");
		$errOccur = false;
		if( !$name ){
			$error['name'] = "Invalid Category Name";
			$errOccur = true;
		}
		else{
			$cat['name'] = $name;
		}

		// var_dump($parent);
		// die();

		if( !$parent || $parent<0 ){
			$parent = '0';
		}
		$cat['parent'] = $parent;

		if( $errOccur ){
			// echo "Error Occured";
			$data['error'] = $error;
			$data['value'] = $value;
			view("cat-form",$data);
		}
		else{
			$cat['status'] = '1';
			// print_r($cat);
			if( insertNewCat($cat) ){
				header("Location:".DOMAIN."/category/show/");
			}
		}

	}
	else{
		$data['error'] = $error;
		$data['value'] = $value;
		view("cat-form",$data);
	}
	// var_dump($cats);
}

function delete($id){

	if( !isCurUserAdmin() ){
		die("Access Denied!");
	}
	if( !$id )die();

	if( !checkNumber( validate( $id) ) ){
		echo "Access Denied";
		exit();
	}

	$cat = getCategory(validate($id));
	$cat['status'] = '0';
	updateCat($cat);
	header("Location:".DOMAIN."/category/show/");


}

function edit($id=false){

	// echo
	if( !isCurUserAdmin() ){
		die("Access Denied!");
	}

	if( !$id )die();

	if( !checkNumber( validate( $id) ) ){
		echo "Access Denied";
		exit();
	}
	$cat = getCategory(validate($id));
	// print_r($cat);
	$cats = getCats();
	$data = array();
	$data['flag'] = 'edit';
	$error = array(
		'name' => '',
		'parent' => ''
	);
	$value = array(
		'name' => $cat['name'],
		'id' => $cat['id']
	);
	$data['prevCats'] = $cats;
	if( $_SERVER['REQUEST_METHOD']=="POST" ){

		$cat = array();
		$name = validateNickName( "name" );
		$errOccur = false;
		if( !$name ){
			$error['name'] = "Invalid Category Name";
			$errOccur = true;
		}
		else{
			$cat['name'] = $name;
		}

		// die();


		if( $errOccur ){
			echo "Error Occured";
			$data['error'] = $error;
			$data['value'] = $value;
			view("cat-form",$data);
		}
		else{
			$cat['id'] = $id;
			$cat['status'] = '1';
			if( updateCat($cat) ){
				header("Location:".DOMAIN."/category/edit/".$id);
			}
			else{
				// echo "Failed";
				// print_r($cat);
			}
		}

	}
	else{
		$data['error'] = $error;
		$data['value'] = $value;
		view("cat-form",$data);
	}

}


function show(){

	$cats = getCats();
	view("cats",$cats);
	// print_r($cats);
}


function getSubFor($id){
	if( validate($id)<1 )return;
	else{
		echo json_encode( getSubCatsOf($id) );
	}
}



?>