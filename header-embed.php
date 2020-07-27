<?php
/**
 * Contains the post embed header template
 *
 * When a post is embedded in an iframe, this file is used to create the header output
 * if the active theme does not include a header-embed.php template.
 *
 * @package WordPress
 * @subpackage Theme_Compat
 * @since 4.5.0
 */

if ( ! headers_sent() ) {
	header( 'X-WP-embed: true' );
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php echo wp_get_document_title(); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
	/**
	 * Prints scripts or data in the embed template head tag.
	 *
	 * @since 4.4.0
	 */
	do_action( 'embed_head' );
	?>
	<style>
		.wp-embed{
			padding: 0;
			background-color: #192231;
			border: none;
		}
		.wp-embed .embedded-main{
			display: flex;
			justify-content: start;
			align-items:center;
		}
		.wp-embed .embedded-post{
			position: relative;
			display:flex; 
			justify-content:center; 
			align-items:center;
			background-size: cover; 
			background-color: #131a28; 
			width: 200px; 
			height: 200px; 
		}
		.wp-embed .embedded-post a{
			position: absolute;
			top: 0;
			left: 0;
			display:flex; 
			justify-content:center; 
			align-items:center;
			width: 200px; 
			height: 200px; 
			color:white;
			font-weight: bold;
			z-index: 10;
		}
		.wp-embed .embedded-post a:hover{
			color: #EBB94A;
		}
		.wp-embed .embedded-post .embedded-back{
			position: absolute;
			top: 0;
			left: 0;
			display:flex; 
			justify-content:center; 
			align-items:center;
			width: 200px; 
			height: 200px; 
			color:white;
			font-weight: bold;
			z-index: 0;
			background-color: #131a28;
			opacity: 0.5;
		}
	</style>
</head>
<body <?php body_class(); ?>>
