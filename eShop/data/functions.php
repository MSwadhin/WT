<?php 


require_once('config.php');



/*
*
* Generic XML Writing
*
*/

function generateXML( $node,&$strArr,$level ){

	$i=0;
	$tabs="";
	while( $i<$level ){
		$tabs .= "	";
		$i++;
	}
	//print_r($node);
	if( isset($node['childs']) && is_array( $node['childs'] ) && count( $node['childs'] )>0 ){
		$strArr[] = $tabs."<".$node['name'].">";
		$i=0;
		foreach ( $node['childs'] as $k=>$c ) {
			generateXML( $c,$strArr,$level+1 );
		}
		$strArr[] = $tabs."</".$node['name'].">";
	}
	else{
		$strArr[] = $tabs."<".$node['name'].">".$node['value']."</".$node['name'].">";
	}
}


function writeXML( $name,$dtd,$element ){
	$str = array();
	generateXML( $element,$str,0 );
	$file = fopen( DATA_PATH.$name.".xml",'w');
	fwrite( $file,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" );
	fwrite($file, "<!DOCTYPE ".$name." SYSTEM \"".DTD_PATH.$dtd."\">\n");
	//print_r($file);
	foreach ($str as $value) {
		fwrite($file,$value."\n");
	}
	fclose($file);
}



/*
*
* Working With User Data
*
*/
function getUserList(){
	return $ul = simplexml_load_file("data/userList.xml");
}

function getUser( $email,$pass ){
	$userList = getUserList();
	$curUser = array();
	foreach( $userList->user as $user ){
		if( $user->email==$email && $user->password==md5($pass) ){
			$curUser['id'] = (string)$user->id;
			$curUser['type'] = (string)$user->type;
			return $curUser;
		}
		//print_r( $user );
	}
	return false;
}


/*
*
* Working With Product Data
*
*/
function getProducts(){

	$products = false;
	$pList = simplexml_load_file('data/productList.xml');
	if( isset( $pList->product ) ){
		$products = array();
		foreach ($pList->product as $p) {
			$cur = array();
			
			$cur['id'] 			= (string)$p->id;
			$cur['name'] 		= (string)$p->name;
			$cur['category'] 	= (string)$p->category;
			$cur['price'] 		= (string)$p->price;
			$cur['quantity'] 	= (string)$p->quantity;
			$cur['offer'] 		= (string)$p->offer;
			$cur['picture'] 	= (string)$p->picture;
			$cur['date'] 		= (string)$p->date;
			$cur['userId'] 		= (string)$p->userId;
			$cur['status'] 		= (string)$p->status;

			$products[] = $cur;
			unset($cur);
		}	
	}
	
	return $products;
}

function getCategories(){
	$categories = array();
	$cList = simplexml_load_file('data/category.xml');
	foreach ( $cList->category as $category ) {
		$categories[] = (string)$category;
	}
	return $categories;
}


function getProduct( $id ){
	$products = getProducts();
	foreach ( $products as $p ) 
		if( $p['id']==$id )return $p;
	return false;
}

function makeProductListElement( $products ){
	$elem = array(
		'name' 	=> 'productList',
		'childs'=> array()
	);
	foreach ( $products as $product ) {
		$cur = array(
			'name' => 'product',
			'childs' => array()
		);
		foreach ($product as $key => $value) {
			$cur['childs'][] = array(
				'name' => $key,
				'value' => $value
			);
		}
		$elem['childs'][] = $cur;
	}
	return $elem;
}


?>