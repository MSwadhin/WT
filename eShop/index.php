<?php 

require_once('functions.php');


if( isCurUserSeller() ){
	header("Location:".DOMAIN."myproducts.php");
	//exit();
}


$buyer = false;
if( isCurUserBuyer() ){
	$buyer = true;
	if( !isset( $_SESSION['cart'] ) )
		readyCart();
}

//print_r( $_SESSION['cart'] );

function showUrl( $p ){
	global $buyer;
	if( $buyer ){
		if( isInCart( $p  ) ){
			echo '<a href="';
			echo '#"';
			echo '>Added To Cart</a>';
		}
		else{
			echo '<a href="';
			echo DOMAIN."cart.php?pid=".$p['id'].'"';
			echo '>Add To Cart</a>';
		}
	}
	else{
		echo '<a href="';
		echo DOMAIN."login.php";
		echo '"">Add to Cart</a>';
	}
}
$products = array();
if( isset( $_GET['category'] ) && isset( $_GET['prange'] )  && $_GET['category']!="" && $_GET['prange']!="" ){
	$rng = explode( '-',$_GET['prange'] );
	$products = getProductsByBoth($rng[0],$rng[1],$_GET['category']);
}
else if( isset( $_GET['category'] ) && $_GET['category']!="" ){
	$products = getProductsByCat($_GET['category']);
}
else if( isset( $_GET['prange'] ) && $_GET['prange']!="" ){
	$rng = explode( '-',$_GET['prange'] );
	$products = getProductByPriceRange( $rng[0],$rng[1] );
}
else{
	$products = getProducts();
}

$categories = getCategories();

include_once('inc/header.php');
//include_once('inc/sidebar.php');


?>

<table width="80%" style="margin-left:10%;">
	<tr>
		<td width="33%">
			<table>
				<form method="get" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ); ?>">
					<tr>
						<td><h2>SHOP</h2></td>
					</tr>
					<tr>
						<td>
							<select name="category">
								<option value="">Category</option>
								<?php 
								foreach ( $categories as $cat ) {
									echo '<a href="#?q=uu"><option value="'.$cat.'">'.$cat.'</option></a>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select name="prange">
								<option value="">Price Range</option>
								<option value="0-100">0-100</option>
								<option value="100-500">100-500</option>
								<option value="500-1000">500-1000</option>
								<option value="1000-100000000000">&gt;1000</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="Find">
						</td>
					</tr>
				</form>
			</table>
			<table>
				<tr>
					<td>
						<a href="<?php echo DOMAIN; ?>index.php?offer=1">Offer Hut</a>
					</td>
				</tr>
			</table>

		</td>
		<td width="70%">
			
<?php 
$i=0;
for( $i=count( $products )-1;$i>=0;$i-- ){
	$pr = $products[$i];
	echo '<table width="190px" style="display:inline-block;margin:30px;margin-left:0px;">';
	?>
		<tr><td><img src="<?php echo "uploads/".$pr['picture'] ?>" alt="Image Not Found" height="190px" width="190px"/></td></tr>
		<tr><td><?php echo $pr['name'] ?></td></tr>
		<tr><td>Tk. <?php echo $pr['price'] ?></td></tr>
		<tr><td><?php showUrl( $pr ); ?></td></tr>
	<?php 

	echo '</table>';
}
?>

</td>
	</tr>
</table>