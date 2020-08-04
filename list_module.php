<?php /* Template Name: Liste Module */ 

$_SESSION['needAdmin'] = true;

get_header(); 

cleanSession();

echo do_shortcode('[qm_display_module_list]');

?>







<?php  get_footer(); ?>