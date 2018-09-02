<?php 

function validatePassword( $pass ){
	if( !isset( $_POST[$pass] ) )	return false;
	if( $_POST[$pass]=="" )		return false;
	if( !preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $_POST[$pass]) )
		return false;
	return validate( $_POST[$pass] );
}

function validateEmail( $email ){

	if( !isset( $_POST[$email] ) )	return false;
	if( !filter_var( $_POST[$email],FILTER_VALIDATE_EMAIL ) )return false;
	return validate( $_POST[$email] );

}

function validateNickName( $uname ){

	if( !isset( $_POST[$uname] ) )	return false;
	if( $_POST[$uname]=="" )		return false;
	if( !preg_match('/^[A-Za-z]{1}[A-Za-z0-9]*$/', $_POST[$uname]) )
		return false;
	return validate( $_POST[$uname] );
}
function validateUserName( $uname ){

	if( !isset( $_POST[$uname] ) )	return false;
	if( $_POST[$uname]=="" )		return false;
	if( !preg_match('/^[A-Za-z]{1}[A-Za-z 0-9]*$/', $_POST[$uname]) )
		return false;
	return validate( $_POST[$uname] );
}

function validatePhone( $name ){
	if( !preg_match( '/^[0-9]{11}$/',$_POST[$name] ) )return false;
	return validate( $_POST[$name] );
}


function validateNumber( $name ){
	if( !preg_match( '/^[1-9][0-9]*$/',$_POST[$name] ) )return false;
	return validate( $_POST[$name] );
}





function validate( $data ){

	return htmlentities( htmlspecialchars( trim( $data ) ) );
}


function getPost($key){
	if( !isset( $_POST[$key] ) )return false;
	else return validate($_POST[$key]);
}


function showErrorMsg($msg){
	echo $msg;
}




function checkNumber( $name ){
	if( !preg_match( '/^[1-9][0-9]*$/',$name ) )return false;
	return validate( $name );
}

?>