<?php 



require_once( '../app/models/sellsModel.php' );
require_once( 'libs/DBHandler.php' );
require_once( 'libs/model.php' );


$id = $_GET['id'];
// var_dump(  );

echo json_encode( getAll($id) );

?>