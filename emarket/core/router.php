<?php 


function initRouter(){


	$url = (isset($_GET['p'])) ? $_GET['p'] : 'home';
	$url = rtrim( $url,"/" );
	$url = explode('/',$url);
	$controller = sprintf( $url[0] );


	// echo $controller;

	include_once(INCS."/header.php");

	if( file_exists( CONTROLLERPATH.'/'.$controller.'.php' ) ){

		if( $controller!="user" )
			include_once(INCS."/sidebar.php");
		require_once( CONTROLLERPATH.'/'.$controller.'.php' );

		if( isset( $url[1] ) ){

			$method = sprintf( $url[1] );
			if( function_exists( $method ) ){

				if( isset( $url[2] ) ){

					$parameters = sprintf( $url[2] );
					// Call Controller Method With Parameters
					$method( $parameters );
				}
				else{

					// Call Controller Method WithOut Parameters
					$method();
				}
			}
			else{

				// Controller Not Found !!!
				echo $method . "Controller Not Found !!! in " . $controller;
			}
		}
		else{
			// Method Not Declared !!!
		}

	}
	else{
		// File Not Found
		echo "File Not Found !! --" . CONTROLLERPATH.'/'.$controller.'.php';
		echo "<br>";
		// echo $url[1];

	}


	include_once(INCS."/footer.php");
}



?>