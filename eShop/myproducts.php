<?php 

require_once('functions.php');
if( !isCurUserSeller() ){
	echo "<h2>You Do Not Have Permission To Access This Page!</h2>";
	exit();
}

$products = getProductsByUser();
//print_r( $products );

include_once( 'inc/header.php' );

?>