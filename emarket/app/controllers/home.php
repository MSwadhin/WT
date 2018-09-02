<?php 


// echo getCurUserId();

if( !defined('ROOT') ){
	die("Invalid Access!");
}


if( !getModel( "productModel" ) ){
	die("Something Went Wrong");
}
if( !getModel( "categoryModel" ) ){
	die("Something Went Wrong");
}



// print_r($products);

if( isCurUserSeller() ){
	echo "<h2>Wlecome Shop Owner</h2>";
}


if( $_SERVER['REQUEST_METHOD']=="POST" ){
	$cid = getPost( "cid" );
	if( $cid<1 )$cid=false;
	$q = getPost( "sq" );
	$sp = getPost( "sp" );
	$products = getProdsBySearch($cid,$q,false,$sp);
}
else{

	$products = getProducts();
}

view("products",$products);

?>
