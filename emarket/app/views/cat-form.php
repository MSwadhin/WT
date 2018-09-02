<?php 

$error = $data['error'];
$value = $data['value'];
$prevCats = $data['prevCats'];

$action = "";
$btnText = "";
if( $data['flag']=='edit' ){
	$action = htmlentities( DOMAIN."/category/edit/".$value['id'] );
	$btnText = "Save";
}
else{
	$action = htmlentities( DOMAIN."/category/add" );
	$btnText = "Add Category";
}

?>

<form action="<?php echo $action; ?>" method="post">
	

	<input type="text" name="name" value="<?php echo $value['name']; ?>">
	<?php if( $error['name']!="" )showErrorMsg( $error['name'] );?>
	<input type="submit" value="<?php echo $btnText; ?>">

</form>