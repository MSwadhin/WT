<?php 


require('data/functions.php');

session_start();

/*
*
* Working With Sessions
*
*/

function setSession( $key,$val ){
	$_SESSION[$key] = $val;
}

function getSession( $key ){
	return ( isset( $_SESSION[$key] ) ) ? $_SESSION[$key] : false;
}







/*
*
* Form Handling Functions
*
*/
function validate( $data ){

	return htmlentities( htmlspecialchars( trim( $data ) ) );
}

function showErrorMsg( $msg ){
	echo $msg."<br/>";
}



/*
*
* User Management
*
*/
/**/
function registerNewUser( $user ){


	//print_r( $user );

	$userList = getUserList();
	$elem = array(
		'name' 		=> 'userList',
		'childs' 	=> array()
	);
	$c=0;
	if( isset($userList->user) ){
		
		foreach ( $userList->user as $us ) {
			if( $us->email == $user['email'] )return false;
			$prev = array(
				'name' => 'user' ,
				'childs' => array() 
			);
			foreach ($us as $key => $value) {
				$prev['childs'][] = array(
					'name' => $key,
					'value'=> $value
				);
			}
			$c++;
			$elem['childs'][]=$prev;
		}	
	}

	$arr = array(
		'name' => 'user',
		'childs'=> array()
	);
	$arr['childs'][] = array(
		'name' => 'id',
		'value'=> ++$c
	);
	foreach ($user as $key => $value) {
		$arr['childs'][] = array(
			'name' => $key,
			'value'=> $value
		);
	}
	$elem['childs'][] = $arr;
	writeXML("userList","UserList.dtd",$elem);
	return true;
}


/**/
function login( $user ){
	$user = getUser( $user['email'],$user['pass'] );
	if( $user!==false ){
		setSession( 'userID',$user['id'] );
		setSession( 'userType',$user['type'] );
		return true;
	}
	return false;
}


/**/
function logout(){

	foreach ($_SESSION as $key => $value) {
		unset( $_SESSION[$key] );
	}
	session_destroy();

}


function isCurUserSeller(){
	$id 	= getSession('userID');
	$type 	= getSession('userType');
	if( $id==false || $type==false )return false;
	if( $type!='seller' )return false;
	return true;
}

function isCurUserBuyer(){
	$id 	= getSession('userID');
	$type 	= getSession('userType');
	if( $id==false || $type==false )return false;
	if( $type!='buyer' )return false;
	return true;
}

function userHaveAccessToProduct( $product ){
	$id 	= getSession('userID');
	if( $product['userId']!=$id )return false;
	return true;
}

function getCurUserId(){
	return getSession('userID');
}


function readyCart(){
	$_SESSION['cart'] = array();
}

function addToCart( $product ){
	$_SESSION['cart'][] = $product;
}
function isInCart( $product ){
	if( isset( $_SESSION['cart'] ) ){
		//print_r( $_SESSION['cart'] );
		foreach ($_SESSION['cart'] as $p=>$pr) {
			//print_r( $pr );
			//echo "Hello";
			if( $pr['id']==$product['id'] )return true;
		}
	}
	return false;
}


/*
*
* Product Management
*
*/

/**/
function addNewProduct( $product ){

	$productList = getProducts();
	$product['id'] = count( $productList ) + 1;
	$productList[] = $product;
	$elem = makeProductListElement( $productList );
	writeXML("productList","ProductList.dtd",$elem);
}


/**/
function updateProduct( $product ){
	$products = getProducts();
	$newList = array();
	$found = false;
	foreach ( $products as $p ) {
		if( $p['id']==$product['id'] ){
			$found = true;
			foreach ( $product as $key => $value ) {
				$p[$key] = $value;
			}
		}
		$newList[] = $p;
	}
	if( !$found )return false;
	$elem = makeProductListElement( $newList );
	writeXML("productList","ProductList.dtd",$elem);
	return true;
}

function getProductsByCat( $cat ){
	$products = getProducts();
	$catProds = array();
	foreach( $products as $product )
		if( $product['category']==$cat )
			$catProds[] = $product;
	return $catProds;
}

function getProductByPriceRange( $low,$high ){
	$products = getProducts();
	$catProds = array();
	foreach( $products as $product )
		if( $product['price']>=$low && $product['price']<=$high )
			$catProds[] = $product;
	return $catProds;
}

function getProductsByBoth( $low,$high,$cat ){
	$products = getProducts();
	$catProds = array();
	foreach( $products as $product )
		if( $product['price']>=$low && $product['price']<=$high && $product['category']==$cat )
			$catProds[] = $product;
	return $catProds;
}


function getProductsByUser(){
	$id = getCurUserId();
	$products = getProducts();
	$catProds = array();
	foreach( $products as $product )
		if( $product['userId']==$id )
			$catProds[] = $product;
	return $catProds;
}


?>