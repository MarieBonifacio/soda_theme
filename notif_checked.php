<?php
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//maj user meta 
$user = $_SESSION["userConnected"];
$timeZone = get_option("timezone_string");
date_default_timezone_set($timeZone);
update_user_meta( $user, $key = 'notification', date("Y-m-d H:i:s") );


?>