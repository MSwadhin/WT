<?php

// MySQL Config..
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// Access Controll
define( 'APP','emarket' );

// Application 
define('MODELPATH', ROOT.'/app/models');
define('VIEWPATH', ROOT.'/app/views');
define('CONTROLLERPATH', ROOT.'/app/controllers');
define('INCS',ROOT."/app/incs");
define('UPLOADS',ROOT."/app/uploads");
// define('ENTITYPATH', ROOT.'/app/entities');



// Domain 
define( 'DOMAIN','http://localhost:8080/emarket' );
define( 'ASSETPAT',DOMAIN.'/app/assets' );
define( 'STYLEPATH',ASSETPAT.'/styles' );
define( 'SCRIPTPATH',ASSETPAT.'/scripts' );
define( 'IMGPATH',ASSETPAT.'/img' );



// Data For Data Analysis

$std = new DateTime("2018-04-10");
$tdy = new DateTime();
$dif = $std->diff($tdy)->d;
define( 'DAYNO',$dif );

?>