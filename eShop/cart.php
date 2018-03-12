<?php 

require_once('functions.php');
if( !isCurUserBuyer() || !isset( $_GET['pid'] )){
	echo "<h2>You Do Not Have Permission To Access This Page!</h2>";
	exit();
}
$pid = $_GET['pid'];
$product = getProduct($pid);
addToCart( $product );
//print_r($_SESSION['cart']);
header("Location:".DOMAIN);

?>