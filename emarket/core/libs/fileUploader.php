<?php 


function uploadFile($name){
	if(!$_FILES[$name]['name'])
		return false;
		//

	$info = pathinfo($_FILES[$name]['name']);
	$ext = $info['extension'];
	if( $ext=="png" || $ext=="jpg" || $ext=="jpeg" ){
		$fileName 	= date("Y.m.d.H.i.s");
		$path 		= UPLOADS."/".$fileName.".".$ext;
		$newName 	= $fileName.".".$ext;
		if( move_uploaded_file($_FILES['productImg']['tmp_name'], $path) ){
			return $newName;
		}
		return false;
	}
	return false;
}


?>