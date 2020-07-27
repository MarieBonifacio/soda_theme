<?php
define('WP_USE_THEMES', false);
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

session_destroy();
wp_logout();
wp_redirect( home_url() );


?>