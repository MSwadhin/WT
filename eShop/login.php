<?php 
require_once( 'functions.php' );

$error = array(
	'email' 	=> '' ,
	'password'	=> '' 
);

$data = array(
	'email' 	=> '' ,
	'password'	=> '' 

);


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
// Flag to Check Errors
$errOccur = false;
// E-mail
	if( isset( $_POST['email'] ) ){
		if( $_POST['email']=="" ){
			$errOccur = true;
			$error['email'] = "E-mail Address Can Not Be Empty";
		}
		else{
			if( !filter_var( $_POST['email'],FILTER_VALIDATE_EMAIL ) ){
				$errOccur = true;
				$error['email'] = "Invalid Email Address";
			}
			else{
				$data['email'] = validate( $_POST['email'] );
			}
		}
	}
	else{
		$errOccur = true;
		$error['email'] = "E-mail Address Can Not Be Empty";
	}
//password
	if( isset( $_POST['password'] ) ){
		if( $_POST['password']=="" ){
			$errOccur = true;
			$error['password'] = "Password Can Not Be Empty";
		}
		else{
			$data['password'] = md5( validate( $_POST['password'] ) );
		}
	}
	else{
		$errOccur = true;
		$error['password'] = "Password Can Not Be Empty";
	}
// Error Check
	if( !$errOccur ){

			$user = array(
				'email' => $data['email'],
				'pass'  => validate( $_POST['password'] )
			);
			if( login($user) ){
				//echo "logged in";
				//print_r( $_SESSION );
				header("Location:".DOMAIN);
			}
			else{
				echo "failed";
			}
	}
}


?>




<!DOCTYPE html>
<html>
	
	<head>
		<title>Login</title>
		<meta charset="UTF-8"/>
	</head>

	<body>
		<form name="register-form" method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ) ?>">
			<?php 
				if( $error['email']!="" ){
					showErrorMsg( $error['email'] );
				}
			?>
			<input type="text" name="email" value="<?php echo $data['email'] ?>" placeholder="abc@xyz.com"/><br/>

			<?php 
				if( $error['password']!="" ){
					showErrorMsg( $error['password'] );
				}
			?>
			<input type="password" name="password" value="<?php echo $data['password'] ?>" placeholder="******"/><br/>
			<input type="submit" value="Login"/>
			<input type="reset" value="Reset"/>
		</form>
	</body>
</html>