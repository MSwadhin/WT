<?php 


$product = $data['product'];
$posts = $data['posts'];

// print_r($product);


$cart = "";
if( !isCurUserSeller() && !isCurUserAdmin() ){
	if( !isInCart( $product ) )
		$cart .= '<a href="'.DOMAIN.'/cart/add/'.$product['id'].'">Add To Cart</a>';
	else 
		$cart .= '<a href="#">Added To Cart</a>';
}


?>

<div class="row">
	
	<div class="row">
		<div class="col-md-6">
			<h2>Name : <?php echo $product['name'];?></h2>
			<h4>Price : Tk<?php echo $product['price'];?></h4>
			<h4>Quantity : <?php echo $product['quantity'];?></h4>
			Picture : <img class="product-thumb" src="<?php echo DOMAIN.'/app/uploads/'.$product['picture'];?>" alt="Not Found">
		</div>
		<div class="col-md-6">
			<div id="canvas">
				<canvas id="lineHolder" height="300px" width="300px"></canvas>
			</div>
		</div>
	</div>

<?php echo $cart; ?>
	
	<div class="row" style="text-align:left;">
		<div class="col-md-6">
			<h3>Add A Post:</h3>

			<form action="<?php echo htmlentities( DOMAIN.'/product/addPost/'.$product['id'] ); ?>" method="post">
				<textarea name="content" id="" cols="30" rows="10"></textarea>
				<br>
				<input type="submit" value="Post">
			</form>
			<br><br>
			<h3>Recent Post:</h3>

<?php 

if( is_array( $posts ) )
foreach ($posts as $key => $post) {

	echo "<p>";
	echo "<b>".$post['nickName']."</b> : <br>";
	echo $post['content'];
	echo "</p>";
	echo "<span>";
	echo $post['date'];
	echo "</span>";
	echo "<br>";
	//echo "<a href=\"/emarket/product/suspendePost/{$post['id']}\" class=\"btn\">Suspend</a>";
}
else{
	echo "No Reviews For This Product";
}

?>		</div>
	</div>

</div>


<?php 

?>
<script>

	var elm = document.getElementById("lineHolder");
	var id = "<?php echo $product['id']; ?>";
	var xmlhttp = new XMLHttpRequest();
    var url = "/emarket/core/rest.php?id="+id;
    // alert(url);
    var supObj;
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var dirObjAll = JSON.parse(xmlhttp.responseText);

            var i;
            var x,y;
            
			var ctx=elm.getContext("2d");
			ctx.strokeStyle = "#000";
			ctx.lineWidth = 5;
			ctx.beginPath();
			ctx.moveTo(0,300);

            for( i=0;i<dirObjAll.length;i++ ){
            	var obj = dirObjAll[i];
            	x = obj['d']*10;
            	y = 300-obj['c']*10;
            	ctx.lineTo(x,y);
            	ctx.stroke();
            	ctx.moveTo(x,y);

            }
            // var dirObj = dirObjAll[content];
            // alert(dirObjAll);
            // callback(elem,dirObj);
           // supObj = dirObj;
        }
        /*else {
                document.getElementById("dir_type_ul").innerHTML = '<h1 style="color:red; font-size:36px;z-index:5;margin-top:200px;">Wait</h1>';
        }*/
    }
    xmlhttp.open("GET", url, false);
    xmlhttp.send();	


</script>