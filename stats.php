<?php /* Template Name: Stats */ get_header();

cleanSession(); 

echo do_shortcode('[qm_display_stats_admin]');
?>

  

<?php get_footer()?>