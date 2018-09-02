<?php 



if( !isCurUserBuyer() )die("Access Denied!");

$prods = $data;
if( count($prods)<1 ){
	echo "<h2>Empty Cart</h2>";
}
else{

?>
<div id="cart-holder" class="row">

	<div class="row cart-row">
		<div class="col-md-6">
			<h2>Invoice of : <?php echo getSession("userName");?></h2>
		</div>
		<div class="col-md-6">
			<h2>Date : <?php echo date("Y:m:d") ?></h2>
		</div>
		
	</div>
	<div class="row cart-row">
		<div class="col-md-3">
			Product ID:
		</div>
		<div class="col-md-3">
			Product Name:
		</div>
		<div class="col-md-3">
			Price:
		</div>
		<div class="col-md-3">
		</div>
	</div>

<?php 
	$total=0;
	foreach ($prods as $key => $value) {
		$prod = $value;
		$total += $prod['price'];
?>
	<div class="row cart-row">
		<div class="col-md-3">
			<?php echo $prod['id']; ?>
		</div>
		<div class="col-md-3">
			<?php echo $prod['name']; ?>
		</div>
		<div class="col-md-3">
			<?php echo $prod['price']; ?>
		</div>
		<div class="col-md-3">
			<a href="<?php echo DOMAIN.'/cart/remove/'.$prod['id']; ?>" class="btn-red">Remove</a>
		</div>
	</div>

<?php 
	}
	?>
	<div class="row cart-row">
		<div class="col-md-4">
			
		</div>
		<div class="col-md-4">
			Total : 
		</div>
		<div class="col-md-4">
			<?php echo $total; ?>
		</div>
	</div>

	<div class="row full">
		<a href="<?php echo DOMAIN.'/cart/checkout' ?>" class="btn">Checkout</a>
	</div>
	<div class="row full">
		<p style="color:red;">Please Print A Copy Of This Invoice Before Checkout!</p>
	</div>

</div>
<?php 
}








?>