<?php 



define('ROOT',dirname(__FILE__));


require_once('core/config.php');
require_once('core/router.php');
require_once('core/functions.php');
require_once('core/libs/fileUploader.php');
require_once('core/libs/DBHandler.php');
require_once('core/libs/sessionController.php');
require_once('core/libs/controller.php');
require_once('core/libs/model.php');
require_once('core/libs/formdata.php');

// echo DAYNO;

startSession();
// $r = new Router();
initRouter();



// connect();
// echo "Hello World!";

?>