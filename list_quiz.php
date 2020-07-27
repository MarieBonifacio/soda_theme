<?php /* Template Name: Liste Quiz */ 

$_SESSION['needAdmin'] = true;

get_header(); 

cleanSession();

echo do_shortcode('[qm_display_quiz_list]');

?>






<?php  get_footer(); ?>