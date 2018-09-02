<?php 


$error = $data['error'];
$value = $data['value'];
$categories = $data['cats'];


$btnTxt = "";
$title  = "";
$action = "";
if( $data['flag']=="edit" ){
	$btnTxt = "Save";
	$title = "Update Product";
	$action = htmlentities(DOMAIN."/product/edit/".$value['id']);
}
else{
	$btnTxt = "Add Product";
	$title  = "Add New Product";
	$action = htmlentities(DOMAIN."/product/add");
}

// print_r($data);

?>

<center>
	
	<h2><?php echo $title; ?></h2>
	<table>
		<form enctype="multipart/form-data" method="post" action="<?php echo $action; ?>">
			<tr>
				<td>Name: </td>
				<td><input type="text" name="name" value="<?php echo $value['name']; ?>" placeholder="product name"/></td>
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
							echo '<option value="'.$cat['id'].'"';
							if( $cat['id']==$value['cid'] )echo 'selected';
							echo '>';
							echo $cat['name'];
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
				<td><input type="text" name="price" value="<?php echo $value['price']; ?>" placeholder="Tk"/></td>
				<td style="color:red;">
				<?php
				if( $error['price']!="" ) showErrorMsg( $error['price'] );
				?>	
				</td>
			</tr>
			

			<tr>
				<td>Quantity: </td>
				<td><input type="text" name="quantity" value="<?php echo $value['quantity']; ?>" placeholder="10"/></td>
				<td style="color:red;">
				<?php
				if( $error['quantity']!="" ) showErrorMsg( $error['quantity'] );
				?>
				</td>
			</tr>
			
			<tr>
				<td>Offer(%):</td>
				<td><input type="text" name="offer" value="<?php echo $value['offer']; ?>" placeholder="10"/></td>
				<td style="color:red;">
				<?php
				if( $error['offer']!="" ) showErrorMsg( $error['offer'] );
				?>
				</td>
			</tr>

			<tr>
				<td><!-- Empty --></td>
				<td>
					<input type="submit" value="<?php echo $btnTxt; ?>">
				</td>
			</tr>	
			
		</form>
	</table>
</center>
