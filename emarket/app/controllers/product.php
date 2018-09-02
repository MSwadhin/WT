<?php 



if( !getModel("productModel") ){
	die("Something Went Wrong");
}

if( !getModel("categoryModel") ){
	die("Something Went Wrong");
}
if( !getModel("postModel") ){
	die("Something Went Wrong");
}
if( !getModel("sellsModel") ){
	die("Something Went Wrong");
}



function my(){
	$products = getProductsByUser( getSession("userId") );
	// print_r($products);
	if( $products ){
		view("products",$products);
	}
	else{
		echo "No Product Found!";
	}
}


function delete($id){
	$pid = checkNumber($id);
	if( !$pid ) die("Access Denied!");
	if( !isCurUserSeller() )die("Access Denied");
	$prod = getProduct( $pid );
	$prod['status'] = '0';
	updateProduct($prod);
	header("Location:".DOMAIN."/product/my");
}


function add(){


	if( isCurUserSeller() ){

		$data  = array();
		$data['flag'] = "add";
		$error = array(
			'name' => '',
			'category' => '',
			'price' => '',
			'quantity' => '',
			'offer' => '',
			'picture' => '',
			'status' => ''
		);
		$value = array(
			'id' => '',
			'name' => '',
			'cid' => '',
			'price' => '',
			'quantity' => '',
			'offer' => '',
			'picture' => '',
			'date' => '',
			'userId' => '',
			'status' => '0',
			'suspended' => '0'
		);
		$cats = getSubCats();
		if( $_SERVER['REQUEST_METHOD']=="POST" ){

			$errOccur = false;
			$name = validateNickName("name");
			$category = getPost("category");
			$price = getPost("price");
			$quantity = validateNumber("quantity");
			$offer = getPost("offer");
			$picture = uploadFile("productImg");
			if( !$name ){
				$errOccur=true;
				$error['name'] = "Invalid Name";
			}
			else{
				$value['name'] = $name;
			}
			if( !$category || $category<1 ){
				$errOccur=true;
				$error['category'] = "Invalid Category";
			}
			else{
				$value['cid'] = $category;
			}
			if( !$price || !preg_match('/^[0-9]*[.]*[0-9]*$/',$price) ){
				$errOccur=true;
				$error['price'] = "Invalid Price";
			}
			else{
				$value['price'] = $price;
			}
			if( !$quantity ){
				$errOccur=true;
				$error['quantity'] = "Invalid Quantity";
			}
			else{
				$value['quantity'] = $quantity;
			}
			if( !$offer || !preg_match('/^[0-9]*[.]*[0-9]*$/',$offer) ){
				$errOccur=true;
				$error['offer'] = "Invalid offer";
			}
			else{
				$value['offer'] = $offer;
			}
			if( !$picture ){
				$errOccur=true;
				$error['picture'] = "Invalid File";
			}
			else{
				$value['picture'] = $picture;
			}

			if( $errOccur ){
				$data['cats'] = $cats;
				$data['error']=$error;
				$data['value']=$value;
				view("product-form",$data);
			}
			else{
				$value['status'] = '1';
				$value['userId'] = getCurUserId();
				$value['date'] = date("Y-m-d");
				if( insertProduct( $value ) ){
					header("Location:".DOMAIN."/product/my");
				}
				else{
					die("Something Went Wrong");
				}
			}

		}
		else{
			$data['cats'] = $cats;
			$data['error']=$error;
			$data['value']=$value;
			view("product-form",$data);
		}
	}
}

function edit( $id ){


	if( isCurUserSeller() ){


		$pid = checkNumber($id);
		if( !$pid )die("Something Went Wrong");
		$value = getProduct($pid);
		if( !$value ){
			echo "Product Not Found!!";
			return;
		}
		if( $value['userId']!=getCurUserId() ){
			die("You Do Not Have Access To This Product");
		}

		$data  = array();
		$data['flag'] = "edit";
		$error = array(
			'name' => '',
			'category' => '',
			'price' => '',
			'quantity' => '',
			'offer' => '',
			'picture' => '',
			'status' => ''
		);
		$cats = getSubCats();
		if( $_SERVER['REQUEST_METHOD']=="POST" ){

			$errOccur = false;
			$name = validateNickName("name");
			$category = getPost("category");
			$price = getPost("price");
			$quantity = validateNumber("quantity");
			$offer = getPost("offer");
			$picture = uploadFile("productImg");
			if( !$name ){
				$errOccur=true;
				$error['name'] = "Invalid Name";
			}
			else{
				$value['name'] = $name;
			}
			if( !$category || $category<1 ){
				$errOccur=true;
				$error['category'] = "Invalid Category";
			}
			else{
				$value['cid'] = $category;
			}
			if( !$price || !preg_match('/^[0-9]*[.]*[0-9]*$/',$price) ){
				$errOccur=true;
				$error['price'] = "Invalid Price";
			}
			else{
				$value['price'] = $price;
			}
			if( !$quantity ){
				$errOccur=true;
				$error['quantity'] = "Invalid Quantity";
			}
			else{
				$value['quantity'] = $quantity;
			}
			if( !$offer || !preg_match('/^[0-9]*[.]*[0-9]*$/',$offer) ){
				$errOccur=true;
				$error['offer'] = "Invalid offer";
			}
			else{
				$value['offer'] = $offer;
			}

			if( $picture ){
				$value['picture'] = $picture;
			}

			if( $errOccur ){
				$data['cats'] = $cats;
				$data['error']=$error;
				$data['value']=$value;
				view("product-form",$data);
			}
			else{
				// $value['status'] = '1';
				// $value['userId'] = getCurUserId();
				// $value['date'] = date("Y-m-d");
				// var_dump(updateProduct( $value));
				if( updateProduct( $value ) ){
					header("Location:".DOMAIN."/product/edit/".$pid);
				}
				else{
					// echo "here";
					die("Something Went Wrong !!!");
				}
			}

		}
		else{
			$data['cats'] = $cats;
			$data['error']=$error;
			$data['value']=$value;
			view("product-form",$data);
		}
	}

}

function show( $id ){
	$pid = checkNumber($id);
	if( !$pid ){
		die("Something Went Wrong");
	}

	$product = getProduct($id);
	if( !$product ){
		echo "Product Not Found";
		return;
	}
	// print_r($product);
	$data = array();
	$data['product'] = $product;
	$data['posts'] = getPostFor($pid);
	// print_r($data['posts']);
	view("single-product",$data);
}


function addPost($id){
	$pid = checkNumber($id);
	if( !$pid ){
		die("Something Went Wrong");
	}

	$product = getProduct($id);
	if( !$product ){
		echo "Product Not Found";
		return;
	}

	if( !isCurUserBuyer() && !isCurUserSeller() ){
		die("Access Denied!");
	}


	if( $_SERVER['REQUEST_METHOD']=="POST" ){
		$content = getPost("content");

		if( !$content ){

		}
		else{

			$post = array(
				'id' => '',
				'userId' => getCurUserId() ,
				'content'=> $content,
				'pid' => $pid,
				'status'=>1,
				'suspended'=>0,
				'date'=>date('l jS \of F Y h:i:s A')
			);
				// print_r($post);
			if( insertNewPost($post) ){
				header("Location:".DOMAIN."/product/show/".$pid);
			}
		}
	}
}


function suspendeProduct( $id ){
	if( !isCurUserAdmin() )die("Access Denied!!");
	$product = getProduct( validate( $id ) );
	if( !$product )return;
	$product['suspended'] = 1;
	if( updateProduct( $product ) ){
		// echo "AIA";
		header("Location:".DOMAIN."/home");
	}
	else{
		// echo "dsfjklf";
	}
}


function restoreProduct( $id ){
	if( !isCurUserAdmin() )die("Access Denied!!");
	$product = getProduct( validate( $id ) );
	if( !$product )return;
	$product['suspended'] = 0;

	if( updateProduct( $product ) )
		header("Location:".DOMAIN."/home");
}


function suspendePost( $id ){
	if( !isCurUserAdmin() )die("Access Denied!");
	$post = getPostById( validate( $id ) );
	if( !$post )return;
	$post['suspended'] = 1;
	updatePost( $post );
	header("Location : ".DOMAIN);
}


function restorePost( $id ){
	if( !isCurUserAdmin() )die("Access Denied!");
	$post = getPostById( validate( $id ) );
	if( !$post )return;
	$post['suspended'] = 0;
	updatePost( $post );
	header("Location : ".DOMAIN);
}



?>