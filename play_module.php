<?php
require('app/class/module.class.php');
require('app/class/module_slide.class.php');
require('app/class/tag.class.php');
require('app/class/quiz.class.php');


$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//JSON encode
$module = new Module();
$module->selectById($_GET['id']);

echo json_encode($module->getInfos($_SESSION['userConnected']));

?>
