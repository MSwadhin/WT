<?php 



if( !getModel("userModel") ){
	die("Database Error");
}


function register(){

	$uid = getCurUserId();
	if( $uid ){
		echo "You are Already Registered";
		exit();
	}

	// $error = array();
	$value = array(
		// 'id' 		=> '' ,
		'nickName' 	=> '' , 
		'name' 		=> '' , 
		'email' 	=> '' ,
		'password'	=> '' ,
		'phone' 	=> '' , 
		'age' 		=> '' , 
		'type' 		=> '' , 
		'address' 	=> '' ,
		'status' 	=> '1'
	);
	$error = array(
		// 'id' 		=> '' ,
		'nickName' 	=> '' , 
		'name' 		=> '' , 
		'email' 	=> '' ,
		'password'	=> '' ,
		'phone' 	=> '' , 
		'age' 		=> '' , 
		'type' 		=> '' , 
		'address' 	=> ''
	);
	$data['error'] = $error;
	$data['value'] = $value;
	if( $_SERVER['REQUEST_METHOD']=="POST" ){
		// print_r($_POST);
		$errOccur = false;
		$nickName 	= validateNickName( "nickName" );
		$name 		= validateUserName("name");
		$email 		= validateEmail("email");
		$password1 	= validatePassword("password");
		$password2 	= validatePassword("password2");
		$phone 		= validatePhone( "phone" );
		$age 		= validateNumber("age");
		$address 	= validate($_POST['address']);
		if( isset($_POST['type']) )
			$type = validate($_POST['type']);
		else 
			$type = 0;



		if( !$nickName ){
			$error["nickName"] = "Invalid Nick Name";
			$errOccur = true;
		}
		else{
			$value['nickName'] = $nickName;
		}
		if( !$name ){
			$error["name"] = "Invalid Name";
			$errOccur = true;
		}
		else{
			$value['name'] = $name;
		}
		if( !$email ){
			$error['email'] = "Invalid Email";
			$errOccur = true;
		}
		else{
			$value['email'] = $email;
		}
		if( !$password1 || !$password2 || $password1!=$password2 ){
			$error['password'] = "Invalid Password";
			$errOccur = true;
		}

		if( !$phone ){
			$error['phone'] = "Invalid Phone Number";
			$errOccur = true;
		}
		else{
			$value['phone'] = $phone;
		}
		
		if( !$age || $age>100 ){
			$error['age']="Invalid Age";
			$errOccur = true;
		}
		else{
			$value['age'] = $age;
		}
		if( !$type || $type<1 ){
			$error['type'] = "You Must Select A Type";
			$errOccur = true;
		}
		else{
			$value['type'] = $type;
		}
		if( !$address || $address=="" ){
			$error['address'] = "Invalid Address";
			$errOccur = true;
		}
		else{
			$value['address'] = $address;
		}
		if( $errOccur ){
			$data['error'] = $error;
			$data['value'] = $value;
			view("register-form",$data);
		}
		else{
			if( getModel("userModel") ){
				// echo "Model Found";
				$value['password'] = md5($password1);
				// Need to Handle Register With Same Email Multiple Times;;;;;;;;;;;;;
				addNewUser( $value );
				header("Location:".DOMAIN."/user/login");
			}
			else{
				echo "Model Not Found";
			}
		}

	}	

	else{

		view("register-form",$data);

	}


}

function login(){


	$uid = getCurUserId();
	if( $uid ){
		echo "You are Already logged in.";
		exit();
	}


	$error = array(
		'email' => '',
		'password' => ''
	);
	$value = array(
		'email' => '',
		'password' => ''
	);
	
	if( $_SERVER['REQUEST_METHOD']=="POST" ){
		$email = validateEmail( "email" );
		$pass  = md5(validatePassword( "password" ));
		$errOccur = false;
		if( !$email ){
			$error['email'] = "Invalid Email Address";
			$errOccur = true;
		}
		else{
			$value['email'] = $email;
		}
		if( !$pass ){
			$error['password'] = "Invalid Password";
			$errOccur = true;
		}
		if( $errOccur ){
			$data['error'] = $error;
			$data['value'] = $value;
			view("login-form",$data);
		}
		else{
			$user = getUser( $email,$pass );
			if( $user ){
				// print_r($user);
				doLogin($user);
				header("Location:".DOMAIN."/");
			}
			else{
				$error['email'] = "Sorry! Wrong User Name Or Password!!";
				$data['error'] = $error;
				$data['value'] = $value;
				view("login-form",$data);
			}
		}
	}	
	else{
		$data['error'] = $error;
		$data['value'] = $value;
		view("login-form",$data);
	}

}

function logOut(){
	closeSession();
	header("Location:".DOMAIN."/");
}



?>