
<?php 

// global $error;
// print_r($data);
// var_dump($data['value']);
$error = $data['error'];
$value = $data['value'];

// exit();

?>

<form name="register-form" method="post" action="<?php echo htmlentities( DOMAIN ); ?>/user/register">
			<center>
				<table cellpadding="10px">

					<tr>
						<td>
							User Name/Shop Name : 
						</td>
						<td>
							<input type="text" name="nickName" value="<?php echo $value['nickName']; ?>" placeholder="First Name" onblur="validateUid(this)"/>
						</td>
						<td>
						<span id="id-error" class="error-box"></span>
						<?php 
							if( $error['nickName']!="" ){
								showErrorMsg( $error['nickName'] );
							}
						?>
						</td>
					</tr>
					
					<tr>
						<td>Full Name : </td>
						<td>
							<input type="text" name="name" value="<?php echo $value['name'] ?>" placeholder="Last Name"/>
						</td>
						<td>
						<?php 
							if( $error['name']!="" ){
								showErrorMsg( $error['name'] );
							}
						?>
						</td>
					</tr>
					
					<tr>
						<td>E-mail : </td>
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
							<input type="password" name="password" value="<?php echo $value['password'] ?>" placeholder="********"/>
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
						<td>Repeat Password : </td>
						<td>
							<input type="password" name="password2" value="" placeholder="********"/><br/>
						</td>
						<td><!-- Error For Password Is Shown Once --></td>
					</tr>

					<tr>
						<td>Phone : </td>
						<td>
							<input type="text" name="phone" value="<?php echo $value['phone'] ?>" placeholder="01XXXXXXXXX"/>
						</td>
						<td>
						<?php 
							if( $error['phone']!="" ){
								showErrorMsg( $error['phone'] );
							}
						?>
						</td>
					</tr>

					<tr>
						<td>Age : </td>
						<td>
							<input type="text" name="age" value="<?php echo $value['age'] ?>" placeholder=""/>
						</td>
						<td>
						<?php 
							if( $error['age']!="" ){
								showErrorMsg( $error['age'] );
							}
						?>
						</td>
					</tr>

					<tr>
						<td>You Are A : </td>
						<td>
							<input type="radio" name="type" value="1"/>Buyer &nbsp;&nbsp;&nbsp;
							<input type="radio" name="type" value="2"/>Shop Owner
						</td>
						<td>
						<?php 
							if( $error['type']!="" ){
								showErrorMsg( $error['type'] );
							}
						?>
						</td>
					</tr>

					<tr>
						<td>Address : </td>
						<td>
							<textarea id="tarea1" name="address" cols="30" rows="10" value="<?php echo $value['address'] ?>"></textarea>
						</td>
						<td>
						<?php 
							if( $error['address']!="" ){
								showErrorMsg( $error['address'] );
							}
						?>
						</td>
					</tr>

					<tr>
						<td><!-- Empty --></td>
						<td>
							<input type="submit" value="Register" />&nbsp;&nbsp;
							<input type="reset" value="Reset Data"/>
						</td>
					</tr>

				</table>
			</center>
		</form>