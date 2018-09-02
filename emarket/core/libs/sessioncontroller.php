<?php 




function checkSession(){
	return isset( $_SESSION['engine'] );
}



function startSession(){

	if( !isset($_SESSION['engine']) ){
		session_start();
		$_SESSION['engine'] = "Started";
		if( !isset( $_SESSION['cart'] ) ){
			$_SESSION['cart'] = array();
		}

	}
}


function getSession( $key=false ){
	if( $key==false )return false;
	if( !isset($_SESSION[$key]) )return false;
	return $_SESSION[$key];
}

function setSession( $key,$val ){
	$_SESSION[$key] = $val;//Caution : It overrides previous value of any given key
}


function closeSession(){
	if(!empty($_SESSION) && is_array($_SESSION)) {
	    foreach($_SESSION as $sessionKey => $sessionValue)
	        session_unset($_SESSION[$sessionKey]);
	}
	session_destroy();
}


?>