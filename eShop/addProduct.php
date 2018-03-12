<?php 

require_once('functions.php');
if( !isCurUserSeller() ){
	echo "<h2>You Do Not Have Permission To Access This Page!</h2>";
	exit();
}



$name = "jfadl aksf  fsdlka ff klsa fkslf kl fs";

$product = array(
	'id' => '',
	'name' => '',
	'category' => '',
	'price' => '',
	'quantity' => '',
	'offer' => '',
	'picture' => '',
	'date' => '',
	'userId' => '',
	'status' => '1'
);
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
			$product['date'] = date("Y-m-d");
			$product['userId'] = getCurUserId();
			$product['status'] = '1';

			$info = pathinfo($_FILES['productImg']['name']);
			$ext = $info['extension'];
			if( $ext=="png" || $ext=="jpg" || $ext=="jpeg" ){
				$fileName = date("Y.m.d.H.i.s");
				$path = 'uploads/'.$fileName.".".$ext;
				$product['picture'] = $fileName.".".$ext;
				if( move_uploaded_file($_FILES['productImg']['tmp_name'], $path) ){
					addNewProduct( $product );
				}
				else{
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
}


$categories = getCategories();
include_once('inc/header.php');


?>
<center>
	
	<h2>Add New Product:</h2>
	<table>
		<form enctype="multipart/form-data" method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ) ?>">
			<tr>
				<td>Name: </td>
				<td><input type="text" name="name" value="" placeholder="product name"/></td>
				<td style="color:red;">
					<?php
					if( $error['name']!="" ) showErrorMsg( $error['name'] );
					?>
				</td>
			</tr>


			<tr>
				<td>Category: </td>
				<td>
					<select name="category">
						<?php
						foreach ( $categories as $cat ) {
							echo '<option value="'.$cat.'">';
							echo $cat;
							echo '</option>';
						}
						?>
					</select>
				</td>
				<td style="color:red;">
					<?php
					if( $error['category']!="" ) showErrorMsg( $error['category'] );
					?>
				</td>
			</tr>


			<tr>
				<td>Image: </td>
				<td><input type="file" name="productImg"/></td>
				<td style="color:red;">
				<?php
				if( $error['picture']!="" ) showErrorMsg( $error['picture'] );
				?>
				</td>
			</tr>
			
			<tr>
				<td>Price: </td>
				<td><input type="text" name="price" value="" placeholder="Tk"/></td>
				<td style="color:red;">
				<?php
				if( $error['price']!="" ) showErrorMsg( $error['price'] );
				?>	
				</td>
			</tr>
			

			<tr>
				<td>Quantity: </td>
				<td><input type="text" name="quantity" value="" placeholder="10"/></td>
				<td style="color:red;">
				<?php
				if( $error['quantity']!="" ) showErrorMsg( $error['quantity'] );
				?>
				</td>
			</tr>
			
			<tr>
				<td>Offer(%):</td>
				<td><input type="text" name="offer" value="" placeholder="10"/></td>
				<td style="color:red;">
				<?php
				if( $error['offer']!="" ) showErrorMsg( $error['offer'] );
				?>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Add"></td>
				<td><input type="reset" value="Reset"></td>
			</tr>	
			
		</form>
	</table>
</center>

<?php 

include_once('inc/footer.php');

?>