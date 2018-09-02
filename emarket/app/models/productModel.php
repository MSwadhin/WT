<?php 


function insertProduct($product){
	if(insertData($product,"id","products"))
		return true;
	return false;
}


function getProducts(){
	$prods = getDataArray("products",false,false,"where status=1 and suspended=0 order by id desc");
	if( $prods && is_array($prods) )
		return $prods;
	return false;
}

function getProductsByUser($id){
	$prods = getDataArray("products",false,false,"where status=1 and userId=".$id." and suspended=0 order by id desc");
	if( $prods && is_array($prods) )
		return $prods;
	return false;
}

function getProduct( $id ){
	$prod = getDataArray("products",false,false,"where id=".$id);
	if( $prod && is_array($prod) )return $prod[0];
	return false;
}


function updateProduct($prod){
	if( updateObj( $prod,"id","products" ) )return true;
	return false;
}


function getProdsBySearch( $cid=false,$q=false,$low=false,$high=false,$suspended=false ){
	$wh = "where status=1";
	if( $cid )$wh .= " and cid=".$cid;
	if( $q )$wh .= " and name like '%".$q."%'";
	if( $low && $high ){
		$wh .= " and price >=".$low." and price<=".$high;
	}
	if( $suspended ){
		$wh .= " and suspended=1";
	}

	// echo $wh;
	// exit();

	$prods = getDataArray("products",false,false,$wh);
	return $prods;
}

?>