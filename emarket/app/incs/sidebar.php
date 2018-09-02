<?php 

if( !defined('ROOT') )die("Access Denied!");

?>

<div class="row">
	<div class="col-md-2">

<?php 


if( isCurUserSeller() ){
	include_once(INCS."/shop-sidebar.php");
}
else if( isCurUserAdmin() ){
	include_once(INCS."/admin-sidebar.php");
	include_once(INCS."/search-sidebar.php");	
}
else{
	include_once(INCS."/search-sidebar.php");		
}

?>

	</div>
	<div class="col-md-10">

