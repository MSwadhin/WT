<?php 
	
require_once('functions.php');

?>

<!DOCTYPE html>
<html>
	<head>
		<title>E-SHOP</title>
		<meta charset="UTF-8">
	</head>
	<body style="widht:100%;">
		<a href="<?php echo DOMAIN; ?>">
			<center><img src="img/logo.png" alt="LOGO" style="height:116px;widht:124px;"></center>
		</a>
		<hr/>
		<center>
			<table>
				<tr>
					<td width="200px"><h3>Latest Products</h3></td>
					<td width="200px">
					
					<?php 
					if( isCurUserSeller() || isCurUserBuyer() ){
						?>
						<center><a href="logout.php">Log Out</a></center>
						<?php 
					}
					else{
						?>
						<center><a href="login.php">Login</a></center>
						<?php 
					}
					?>
					</td>
					<td  width="200px">
					<?php 
					if( isCurUserSeller() ){
						?>
						<center><a href="addProduct.php">Add New Product</a></center>
						<?php 
					}
					else if( isCurUserBuyer() ){
						?>
						<center><a href="mycart.php">My Cart</a></center>
						<?php 
					}
					else{
						?>
						<center><a href="register.php">Register</a></center>
						<?php 
					}
					?>
					</td>
				</tr>
			</table>
		</center>
		
	