<?php 


function addNewUser( $user ){
	if( insertData( $user,"id","users" ) ){
		// echo "Ya";
		return true;
	}
	return false;
}


function getUser( $email,$pass ){
	$user = getDataArray("users",false,false,"where email='".$email."' and password='".$pass."'");
	if( $user && is_array($user) )
		return $user[0];
	return false;
}

?>