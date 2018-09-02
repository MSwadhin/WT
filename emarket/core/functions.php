<?php 



// User Management

function doLogin( $user ){
	setSession("userId",$user['id']);
	setSession("userName",$user['name']);
	setSession("userType",$user['type']);
	setSession("status",$user['status']);
}


function isCurUserBuyer(){
	$type = getSession("userType");
	if( !$type )return false;
	if( $type==1 )return true;
	return false;
}

function isCurUserSeller(){
	$type = getSession("userType");
	if( !$type )return false;
	if( $type==2 )return true;
	return false;
}

function isCurUserAdmin(){
	$type = getSession("userType");
	if( !$type )return false;
	if( $type==3 )return true;
	return false;
}



function getCurUserId(){
	$uid = getSession('userId');
	if( !$uid )return false;
	return $uid;
}


function isUserSuspended(){
	return getSession("status");
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


function removeFromCart( $product ){

	if( $_SESSION['cart'] && is_array($_SESSION['cart'])){
		// if( )
		$i=0;
		foreach( $_SESSION['cart'] as $key=>$p ) {
			if( $p['id']==$product['id'] ){
				// echo $product['id'];
				unset( $_SESSION['cart'][$key] );
			}
			$i++;
		}

		// print_r($_SESSION['cart']);
	}
}


function getCartProducts(){
	$prods = array();
	if( isset( $_SESSION['cart'] ) && is_array( $_SESSION['cart'] ) )
		foreach( $_SESSION['cart']  as $P )
			$prods[] = $P;
	return $prods;
}

?>