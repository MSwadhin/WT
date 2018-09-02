<?php 


$cats = $data;


foreach ($cats as $key => $value) {
	?>
	
	<div class="row">
		<div class="col-md-2"><?php echo $value['name']; ?></div>
		<div class="col-md-2"><a href="<?php echo DOMAIN.'/category/edit/'.$value['id']; ?>" class="btn">Edit</a></div>
		<div class="col-md-2"><a href="<?php echo DOMAIN.'/category/delete/'.$value['id']; ?>" class="btn">Delete</a></div>
	</div>

	<?php 
}


?>