<?php /* Template Name: Accueil */ get_header();

cleanSession();

 ?>



<div class="home">

  <div class="dashboard">

    <div class="window actu">

      <h3>Fil d'actualité</h3>

      <?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>

        <?php echo do_shortcode( '[activity-stream allow_posting=true]' ); ?>

			<?php } else { ?>	

        <?php echo do_shortcode( '[activity-stream allow_posting=false]' ); ?>

			<?php }?>

    </div>

    <div class="window quiz lastQ">

      <h3>Dernier quiz</h3>

    </div>

    <div class="window results">

      <h3>Vos résultats</h3>

      <div class=chartDiv>
        <?php echo do_shortcode('[qm_display_stats_acceuil]');?>
      </div>

    </div>

    <div class="window news">

      <h3>Dernières news</h3>

        <?php echo do_shortcode( '[display-posts image_size="medium" wrapper="div" wrapper_class="display-posts-listing grid"  posts_per_page="3"]' ); ?>

    </div>

    <div class="window leaderboard">

       <?php echo do_shortcode('[qm_display_classement_acceuil]');?>

      </div>

    </div>

  </div>

</div>



<?php  get_footer(); ?>