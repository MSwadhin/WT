<?php 

require_once('functions.php');
if( !isCurUserSeller() || !isset( $_GET['pid'] )){
	echo "<h2>You Do Not Have Permission To Access This Page!</h2>";
	exit();
}
$userId = getCurUserId();
$pid = $_GET['pid'];
if( !preg_match('/^[0-9]*$/',$pid) ){
	echo "<h2>You Do Not Have Permission To Access This Page!</h2>";
	exit();
}
$product = getProduct($pid);

if( !userHaveAccessToProduct( $product ) ){
	echo "<h2>You Do Not Have Permission To Access This Page!</h2>";
	exit();
}



$error = array(
	'name' => '',
	'category' => '',
	'price' => '',
	'quantity' => '',
	'offer' => '',
	'picture' => '',
);


$errOccur=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

// name
	if( isset( $_POST['name']) && $_POST['name'] !="" ){
		if( !preg_match('/^[A-Za-z]{1}[A-Za-z0-9]*$/', $_POST['name']) ){
			$errOccur = true;
			$error['name'] = "Product Name Invalid!";	
		}
		else{
			$product['name'] = validate( $_POST['name'] );
		}
	}
	else{
		$errOccur = true;
		$error['name'] = "Product Name Can Not Be Empty!";
	}

// category
	if( isset( $_POST['category']) && $_POST['category'] !="" ){
		$product['category'] = validate( $_POST['category'] );
	}
	else{
		$errOccur = true;
		$error['category'] = "You Must Select Any Category!";
	}

// Price
	if( isset( $_POST['price']) && $_POST['price'] !="" ){
		if( !preg_match('/^[0-9]*[.]*[0-9]*$/', $_POST['price']) ){
			$errOccur = true;
			$error['price'] = "Product Price Invalid!";	
		}
		else{
			$product['price'] = validate( $_POST['price'] );
		}
	}
	else{
		$errOccur = true;
		$error['price'] = "Product Price Can Not Be Empty!";
	}

// quantity
	if( isset( $_POST['quantity']) && $_POST['quantity'] !="" ){
		if( !preg_match('/^[1-9]{1}[0-9]*$/', $_POST['quantity']) ){
			$errOccur = true;
			$error['quantity'] = "Product Quantity Invalid!";	
		}
		else{
			$product['quantity'] = validate( $_POST['quantity'] );
		}
	}
	else{
		$errOccur = true;
		$error['quantity'] = "Product Quantity Can Not Be Empty!";
	}

// offer
	if( isset( $_POST['offer']) && $_POST['offer'] !="" ){
		if( !preg_match('/^[1-9]{1}[0-9]*$/', $_POST['offer']) ){
			$errOccur = true;
			$error['offer'] = "Product Offer Invalid!";	
		}
		else{
			$product['offer'] = validate( $_POST['offer'] );
		}
	}
	else{
		$product['offer'] = '0';
	}

// picture
	if(!$_FILES['productImg']['name']){
		$errOccur = true;
		$error['picture'] = "Must Select A Picture For Product!";
	}
	else{
		//
		if( $errOccur==false ){

			$info = pathinfo($_FILES['productImg']['name']);
			$ext = $info['extension'];
			if( $ext=="png" || $ext=="jpg" || $ext=="jpeg" ){
				$fileName = date("Y.m.d.H.i.s");
				$path = 'uploads/'.$fileName.".".$ext;
				$product['picture'] = $fileName.".".$ext;
				if( !move_uploaded_file($_FILES['productImg']['tmp_name'], $path) ){
					$errOccur = true;
					$error['picture'] = "Problem Uploading File";
				}
			}
			else{
				$errOccur = true;
				$error['picture'] = "Wrong File Format";
			}

			
		}
	}


	if( !$errOccur ){
		//////////////////
		$product['userId'] = getCurUserId();
		$product['status'] = 1;
	}


}


$categories = getCategories();
include_once('inc/header.php');


?>

<form enctype="multipart/form-data" method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ) ?>">

	<?php
	if( $error['name']!="" ) showErrorMsg( $error['name'] );
	?>
	<input type="text" name="name" value="" placeholder="product name"/><br/>

	<?php
	if( $error['category']!="" ) showErrorMsg( $error['category'] );
	?>
	<select name="category">
		<?php
		foreach ( $categories as $cat ) {
			echo '<option value="'.$cat.'">';
			echo $cat;
			echo '</option>';
		}
		?>
	</select><br/>
	<?php
	if( $error['picture']!="" ) showErrorMsg( $error['picture'] );
	?>
	<input type="file" name="productImg"/><br/>
	<?php
	if( $error['price']!="" ) showErrorMsg( $error['price'] );
	?>
	<input type="text" name="price" value="" placeholder="Tk"/><br/>
	<?php
	if( $error['quantity']!="" ) showErrorMsg( $error['quantity'] );
	?>
	<input type="text" name="quantity" value="" placeholder="10"/><br/>
	<?php
	if( $error['offer']!="" ) showErrorMsg( $error['offer'] );
	?>
	<input type="text" name="offer" value="" placeholder="10"/><br/>
	<input type="submit" value="Add">
</form>


<?php 

include_once('inc/footer.php');

?>