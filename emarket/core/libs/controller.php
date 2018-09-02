<?php 


function getModel( $modelName ) {

	// includes model file 
	// returns new model object
	if( file_exists( MODELPATH . '/' . $modelName . '.php' ) ){
		require_once( MODELPATH . '/' . $modelName . '.php' );
		return true;
	}else{
		echo "Model Not Found-- " .$modelName;
	}
	return false;
	
}

function view( $viewName,$data = false) {


	if( file_exists( VIEWPATH . '/' . $viewName . '.php' ) ){
		require_once( VIEWPATH . '/' . $viewName . '.php' );
	}
	else{
		echo "View Not Found -- " . VIEWPATH . '/' . $viewName . '.php';
	}
}


?>