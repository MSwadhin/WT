<?php 


$products = $data;

// var_dump($products);


if( count( $products )>0 )

foreach ($products as $key => $product) {
?>

	<div class="col-md-3">

		<h3><?php echo $product['name']; ?></h3>
		<img src="/emarket/app/uploads/<?php echo $product['picture']; ?>" alt="Not Found" class="product-thumb">
		<span class="price">Tk.<?php echo $product['price']; ?></span>
		<a href="/emarket/product/show/<?php echo $product['id'];?>" class="btn">View</a>
		<?php 
		if( isCurUserSeller() ){
		?>
		<a href="/emarket/product/edit/<?php echo $product['id'];?>" class="btn">Edit</a>
		<a href="/emarket/product/delete/<?php echo $product['id'];?>" class="btn">Delete</a>

		<?php 
		}
		else if( isCurUserBuyer() ){

			if( !isInCart( $product ) ){
		?>
		<a href="/emarket/cart/add/<?php echo $product['id'];?>" class="btn">Add to Cart</a>

		<?php 
			}
			else{
				echo "<a href='#'>Added To Cart</a>";
			}
		}
		else if( isCurUserAdmin() ){
			if( $product['suspended']==0 ){
		?>
			<a href="/emarket/product/suspendeProduct/<?php echo $product['id'];?>" class="btn">Suspend</a>

		<?php 
			}
			else{
				?>

					<a href="/emarket/product/restoreProduct/<?php echo $product['id'];?>" class="btn">Restore</a>

				<?php 
			}

		}
		?>
		 <!-- <span class="price"><?php echo $product['price']; ?></span>  -->
		<!-- <a href="#">Add to Cart</a> -->
	</div>

<?php 
}

else{
	echo "No Products Found!!";
}

?>