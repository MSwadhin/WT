<?php 



/*
*
* ========= makeColumns Method 
* =============== Makes Columns Part of Query
* =============== Needed in insertObj Method
*/
function makeColumns( $arr,$primaryKey ){

	$columns = "(";
	foreach( $arr as $key=>$val ){
		if( $key==$primaryKey || $val==false || !isset($key) )
			continue;
		$columns .= $key;
		$columns .= ",";
	}
	$columns = rtrim( $columns,',' );
	$columns .= ")";
	return $columns; 
}


/*
*
* ========= makeValues Method 
* =============== Makes Values Part of Query
* =============== Needed in insertObj Method
*/
function makeValues( $arr,$primaryKey ){

	$values = "(";
	foreach( $arr as $key=>$val){
		if( $key==$primaryKey || $val==false || !isset($key) )
			continue;
		$values .= "'".$val."',";
	}
	$values = rtrim( $values,',' );
	$values .= ")";
	return $values;
}


/*
*
* ========= makeUpdateRule Method 
* =============== Makes Update Part of Query
* =============== Needed in updateObj Method
*/
function makeUpdateRule( $arr,$primaryKey ){

	$updateRule = " set ";
	foreach( $arr as $key=>$val ){
		if( $key==$primaryKey || $val===false || !isset($key)  )
			continue;
		$updateRule .= $key . " ='".$val."',";
	}
	$updateRule = rtrim($updateRule,',');
	$updateRule .= " where ".$primaryKey."='".$arr[$primaryKey]."'";
	return $updateRule;
}


function makeEntityArray( $array,$entityName=false ){
	if( !isset($array) || !is_array($array) )
		return false;
	$entityArray = array();
	foreach( $array as $curEntity ){
		$entity = array();
		foreach( $curEntity as $property=>$value ){
			$entity[$property] = $value;
		}
		array_push($entityArray,$entity);
	}
	//print_r($entityArray);
	return $entityArray;
}


/*
*
* ========= insertObj Method 
* =============== Inserts An Object to Table
*/
function insertData( $obj,$primaryKey,$tableName ){
	

	$arr = (array)$obj;	
	// print_r($arr);
	$columns = makeColumns( $arr,$primaryKey );	
	$values  = makeValues( $arr,$primaryKey );	
	$sql = "insert into " . $tableName . " " . $columns . " values " . $values;	
	// echo $sql;
	// exit();
	if ( updateDB( $sql )>0 )	
		return true;
	return false;
}


/*
*
* ========= updateObj Method 
* =============== Updates An Object in Table
*/
function updateObj( $obj,$primaryKey,$tableName ){

	$updateRule = makeUpdateRule( (array)$obj,$primaryKey );
	$sql = "update ".$tableName." ".$updateRule;
	// echo $sql;
	// die();
	if ( updateDB( $sql )>0 )
		return true;
	return false;
}


/*
*
* ========= deleteObj Method 
* =============== Delete An Object from Table
*/
function deleteObj( $obj,$key=false,$tableName=false ){

	if( $key==false )
		return false;
	$arr = (array)$obj;
	$sql = "delete from ".$tableName." where ".$key."='".$arr[$key]."'";
	//echo $sql;
	if ( updateDB( $sql )>0 )
		return true;
	return false;
}




/*
*
* ========= getDataArray Method 
* =============== Returns  An Array from Table
* =============== Containing Objects of Given Class
* =============== Handles Limit, Condition ( Here addition )
*/
function getDataArray( $tableName,$lowLimit=false,$count=false,$addition=false ){


	$sql = "select * from ".$tableName." ";
	if( $addition!==false )
		$sql .= $addition;
	if( $lowLimit!==false && $count!==false ){
		$sql .= " limit ".$count." ";
		if( $lowLimit!==0 ){
			$sql .= " offset ".$lowLimit." ";
		}
	}
	//echo $sql;
	$res = getResult( $sql );
	$entity;
	$entityList = array();
	if( isset( $res ) && $res!=false ){
		$res = $res->fetch_all(MYSQLI_ASSOC);

		/*foreach( $res as $curEntity ){
			$entity = new $entityName();
			foreach( $curEntity as $key=>$value ){
				$entity->$key = $value;
			}
			array_push( $entityList,$entity );
		}
		//print_r( $entityList );
		return $entityList;*/
		return makeEntityArray( $res )	;
	}
	
	return false;
}

	


?>