<?php /* Template Name: Classement */ 

$_SESSION['needAdmin'] = true;

get_header();

cleanSession(); 

echo do_shortcode('[qm_display_classement_admin]');
?>






<?php get_footer();?>