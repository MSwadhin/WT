<?php 

// global $error;
// print_r($data);
// var_dump($data['value']);
$error = $data['error'];
$value = $data['value'];

// exit();

?>




		<center>
			<h2>User Login</h2>
			<form name="register-form" method="post" action="<?php echo htmlentities(DOMAIN); ?>/user/login">
				<table cellpadding="10px">

					<tr>
						<td>
							E-mail : 
						</td>
						<td>
							<input type="text" name="email" value="<?php echo $value['email'] ?>" placeholder="abc@xyz.com"/>
						</td>
						<td>
						<?php 
							if( $error['email']!="" ){
								showErrorMsg( $error['email'] );
							}
						?>
						</td>
					</tr>

					<tr>
						<td>Password : </td>
						<td>
							<input type="password" name="password" value="<?php echo $value['password'] ?>" placeholder="******"/>
						</td>
						<td>
						<?php 
							if( $error['password']!="" ){
								showErrorMsg( $error['password'] );
							}
						?>
						</td>
					</tr>

					<tr>
						<td><!-- Empty --></td>
						<td>
							<input type="submit" value="Login"/>&nbsp;&nbsp;
							<input type="reset" value="Reset"/>
						</td>
					</tr>
					
				</table>
			</form>
		</center>