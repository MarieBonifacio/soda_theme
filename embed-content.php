<?php
/**
 * Contains the post embed content template part
 *
 * When a post is embedded in an iframe, this file is used to create the content template part
 * output if the active theme does not include an embed-content.php template.
 *
 * @package WordPress
 * @subpackage Theme_Compat
 * @since 4.5.0
 */
?>
	<div <?php post_class( 'wp-embed' ); ?>>
		<?php
		$thumbnail_id = 0;

		if ( has_post_thumbnail() ) {
			$thumbnail_id = get_post_thumbnail_id();
		}

		if ( 'attachment' === get_post_type() && wp_attachment_is_image() ) {
			$thumbnail_id = get_the_ID();
		}
		
		?>
		<div class="embedded-main">
			<div class="embedded-post" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
				<div class="embedded-back"></div>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		</div>
		
	</div>
<?php
