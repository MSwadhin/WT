<?php

require_once( 'functions.php' );

$error = array(
	'fname' 	=> '' , 
	'lname' 	=> '' , 
	'email' 	=> '' ,
	'password'	=> '' ,
	'phone' 	=> '' , 
	'age' 		=> '' , 
	'city' 		=> '' , 
	'type' 		=> '' , 
	'address' 	=> ''
);

$data = array(
	'fname' 	=> '' , 
	'lname' 	=> '' , 
	'email' 	=> '' ,
	'password'	=> '' , 
	'phone' 	=> '' , 
	'age' 		=> '' , 
	'city' 		=> '' , 
	'type' 		=> '' , 
	'address' 	=> ''
);

// Flag to Check Errors
$errOccur = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//print_r( $_POST );


// validating data

// Firstname
	if( isset( $_POST['fname'] ) ){
		if( $_POST['fname']=="" ){
			$errOccur = true;
			$error['fname'] = "First Name Can Not Be Empty";
		}
		else{
			if( !preg_match('/^[A-Za-z]{1}[A-Za-z0-9]*$/', $_POST['fname']) ){
				$errOccur=true;
				$error['fname'] = "Invalid First Name";
			}
			else{
				$data['fname'] = validate( $_POST['fname'] );	
			}
			
		}
	}
	else{
		$errOccur = true;
		$error['fname'] = "First Name Can Not Be Empty";
	}
// Lastname
	if( isset( $_POST['lname'] ) ){
		if( $_POST['lname']=="" ){
			$errOccur = true;
			$error['lname'] = "Last Name Can Not Be Empty";
		}
		else{
			if( !preg_match('/^[A-Za-z]{1}[A-Za-z0-9]*$/', $_POST['lname']) ){
				$errOccur=true;
				$error['lname'] = "Invalid Last Name";
			}
			else{
				$data['lname'] = validate( $_POST['lname'] );	
			}
		}
	}
	else{
		$errOccur = true;
		$error['lname'] = "Last Name Can Not Be Empty";
	}
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
// Password
	if( isset( $_POST['password'] ) && isset( $_POST['password2'] )){
		if( $_POST['password']=="" || $_POST['password2']=="" ){
			$errOccur = true;
			$error['password'] = "Password Can Not Be Empty";
		}
		else if( $_POST['password']!=$_POST['password2'] ){
			$errOccur=true;
			$error['password'] = "Passwords Don't Match";
		}
		else{
			$data['password'] = md5( validate( $_POST['password'] ) );
		}
	}
	else{
		$errOccur = true;
		$error['password'] = "Password Can Not Be Empty";
	}
// Phone
	if( isset( $_POST['phone'] ) ){
		if( $_POST['phone']=="" ){
			$errOccur = true;
			$error['phone'] = "Phone Number Can Not Be Empty";
		}
		else{
			if( !preg_match('/^[0-9]{11}$/', $_POST['phone']) ){
				$errOccur=true;
				$error['phone'] = "Invalid Phone Number";
			}
			else{
				$data['phone'] = validate( $_POST['phone'] );	
			}
			
		}
	}
	else{
		$errOccur = true;
		$error['phone'] = "Phone Number Can Not Be Empty";
	}
// Age
	if( isset( $_POST['age'] ) ){
		if( $_POST['age']=="" ){
			$errOccur = true;
			$error['age'] = "Age Can Not Be Empty";
		}
		else{
			if( !preg_match('/^[0-9]{2}$/', $_POST['age']) ){
				$errOccur=true;
				$error['age'] = "Invalid Age";
			}
			else{
				$data['age'] = validate( $_POST['age'] );	
			}
			
		}
	}
	else{
		$errOccur = true;
		$error['age'] = "Invalid Age";
	}
// City
	if( isset( $_POST['city'] ) && $_POST['city']!="0" ){
		$data['city'] = validate( $_POST['city'] );
	}
	else{
		$errOccur=true;
		$error['city'] = "You Must Select A City!";
	}	
// Type
	if( isset( $_POST['type'] ) ){
		$data['type'] = validate( $_POST['type'] );
	}
	else{
		$errOccur=true;
		$error['type'] = "You Must Select Any User Type";
	}

// Address
	if( isset( $_POST['address'] ) ){
		if( empty( $_POST['address'] ) ){
			$errOccur = true;
			$error['address'] = "Address Can Not Be Empty";
		}
		else{
			$data['address'] = htmlspecialchars( ( $_POST['address'] ) );
			//$addr = htmlspecialchars( ( $_POST['address'] ) );
			//$addr = explode( " ",$addr );
			//print_r( $addr );
			//foreach ( $addr as $str ) {
			//	$data['address'] .= $str."_";
			//}
			//rtrim( $data['address'],'_' );
			//$data['address'] = ;	
			//print_r( $data['address'] );
			//echo $data['address'];
		}
	}
	else{
		$errOccur = true;
		$error['address'] = "Address Can Not Be Empty";
	}
	//$data['address'] = htmlspecialchars( ( $_POST['address'] ) );
// Error Check
	if( !$errOccur ){
		if( registerNewUser( $data ) ){
			$user = array(
				'email' => $data['email'],
				'pass'  => validate( $_POST['password'] )
			);
			if( login($user) ){
				header("Location:".DOMAIN);
			}
			else{
				echo "Not Logged In";
			}
			
		}
		else{
			$error['email'] = "E-mail Already Exists!";
		}
	}
	
}


?>





<!DOCTYPE html>
<html>
	
	<head>
		<title>Register</title>
		<meta charset="UTF-8"/>
	</head>

	<body>
		<form name="register-form" method="post" action="<?php echo htmlentities( $_SERVER['PHP_SELF'] ) ?>">
			<?php 
				if( $error['fname']!="" ){
					showErrorMsg( $error['fname'] );
				}
			?>
			<input type="text" name="fname" value="<?php echo $data['fname'] ?>" placeholder="First Name"/><br/>

			<?php 
				if( $error['lname']!="" ){
					showErrorMsg( $error['lname'] );
				}
			?>
			<input type="text" name="lname" value="<?php echo $data['lname'] ?>" placeholder="Last Name"/><br/>

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
			<input type="password" name="password" value="<?php echo $data['password'] ?>" placeholder="********"/><br/>
			<input type="password" name="password2" value="<?php echo $data['fname'] ?>" placeholder="********"/><br/>

			<?php 
				if( $error['phone']!="" ){
					showErrorMsg( $error['phone'] );
				}
			?>
			<input type="text" name="phone" value="<?php echo $data['phone'] ?>" placeholder="01XXXXXXXXX"/><br/>

			<?php 
				if( $error['age']!="" ){
					showErrorMsg( $error['age'] );
				}
			?>
			<input type="text" name="age" value="<?php echo $data['age'] ?>" placeholder=""/><br/>

			<?php 
				if( $error['city']!="" ){
					showErrorMsg( $error['city'] );
				}
			?>
			<select name="city">
				<option value="0">None</option>
				<option value="dhaka">Dhaka</option>
				<option value="khulna">Khulna</option>
				<option value="chittagong">Chittagong</option>
				<option value="barisal">Dhaka</option>
				<option value="rajshahi">Dhaka</option>
				<option value="comilla">Dhaka</option>
			</select><br/>

			<?php 
				if( $error['type']!="" ){
					showErrorMsg( $error['type'] );
				}
			?>
			<input type="radio" name="type" value="buyer"/><br/>
			<input type="radio" name="type" value="seller"/><br/>

			<?php 
				if( $error['address']!="" ){
					showErrorMsg( $error['address'] );
				}
			?>
			<textarea id="tarea1" name="address" cols="30" rows="10" value="<?php echo $data['address'] ?>"></textarea><br/>
			<input type="submit" value="Register" />
			<input type="reset" value="Reset Data"/>
		</form>
	</body>
</html>