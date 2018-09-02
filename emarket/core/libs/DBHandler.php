<?php



function connect(){

	$userName = "root";
	$password = "";
	$host = "localhost";
	$dbName = "emarket";
	$connection = null;
	try{
		$connection = new mysqli(
			$host,
			$userName,
			$password,
			$dbName
		);
	}
	catch( Exception $ex ){
		echo $ex->getMessage();
	}
	return $connection;
}


function getResult( $sql=false ){


	$connection = connect();

	// print_r($connection);

	if( $connection==null ){
		echo "Connection Not Established !! <br> Can Not Execute Query.";
		return false;
	}
	$result = null;

	// echo $sql."<br>";

	if( $sql!==false ){
		try{
			$result = $connection->query( $sql );
		}
		catch( Exception $ex ){
			echo $ex.getMessage();
		}
	}
	$connection = null;
	return $result;
}





function updateDB( $sql=false ){

	$connection = connect();

	if( $connection==null ){
		echo "Connection Not Established !! <br> Can Not Execute Query.";
		return 0;
	}
	$numRows = 0;
	if( $sql!==false ){
		// echo $sql;
		// exit();
		try{
			$result = $connection->query( $sql );
			$numRows = mysqli_affected_rows( $connection );
		}
		catch( Exception $ex ){
			// echo $ex.getMessage();
		}
	}
	$connection = null;
	return $numRows;
}

?>