<?php 


// echo "Hello";


?>

<!DOCTYPE html>
<html>
	<head>
		<title>E-Market</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" href="/emarket/app/assets/styles/reset.css">
		<link rel="stylesheet" href="/emarket/app/assets/styles/rows.css">
		<link rel="stylesheet" href="/emarket/app/assets/styles/cols.css">
		<link rel="stylesheet" href="/emarket/app/assets/styles/style.css">
	</head>
	<body>

		<div id="header" class="row full">
			<div class="col-md-4">
				<a href="/emarket/" class="logo-text">E-Market</a>
			</div>
			<?php 
			if( isCurUserBuyer() || isCurUserSeller() || isCurUserAdmin() ){
			?>
			<div class="col-md-8">

				<?php 

				if( isCurUserBuyer() ){

					?>
				<a href="/emarket/cart/show" class="btn-red">My Cart</a>

					<?php 
				}

				?>
				<a href="/emarket/user/logout" class="btn-red">
					Logout
				</a>
			</div>
			<?php 
			}
			else{
				?>
			<div class="col-md-8">
				<a href="/emarket/user/register" class="btn-red">
					Register
				</a>
				<a href="/emarket/user/login" class="btn-red">
					Login
				</a>
			</div>
			
				<?php
			}

			?>
		</div>


		<div class="row full">
		
	