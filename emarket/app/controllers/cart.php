<?php 


if( !getModel("productModel") )die("Something Went Wrong");
if( !getModel("userModel") )die("Something Went Wrong");
if( !getModel("sellsModel") )die("Something Went Wrong");

function add($id){

	// echo "dsfsdffds";
	// echo $id;
	if( isCurUserBuyer() ){
		$pid = validate($id);
		$product = getProduct($pid);
		// print_r($product);
		$_SESSION['cart'][] = $product;
		// print_r($_SESSION['cart']);
		header("Location:".DOMAIN."/");
	}
	else{
		header("Location:".DOMAIN."/user/login");
	}


	// echo "dsfsdffds";

}


function show(){
	$prods = getCartProducts();
	// print_r($_SESSION['cart']);
	view("cart-view",$prods);
}


function remove($id){
	if( isCurUserBuyer() ){
		$pid = validate($id);
		$product = getProduct($pid);
		removeFromCart($product);
		// print_r($product);
		// print_r($_SESSION['cart']);
		header("Location:".DOMAIN."/cart/show");
	}
	else{
		header("Location:".DOMAIN."/user/login");
	}
}


function checkOut(){

	$prods = getCartProducts();
			// print_r($prods);
			// print_r($_SESSION['cart']);
	if( count($prods)>0 ){
		// $i=0;
		foreach ($prods as $product) {
			// print_r($product);
			$product['quantity']--;
			removeFromCart($product);
			updateProduct($product);
			$sells = array(
				'id' => '',
				'pid' => $product['id'],
				'dayno' => DAYNO
			);
			insertSells($sells);
			unset($sells);
		}
	}
	$_SESSION['cart'] = array();

	header("Location:".DOMAIN."/");

}


?>