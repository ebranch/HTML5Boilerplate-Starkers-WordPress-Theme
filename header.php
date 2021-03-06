<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
	        <meta http-equiv="x-ua-compatible" content="ie=edge">	
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			wp_title( '|', true, 'right' );
		?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		
		<?php
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
?>
	</head>
	<body <?php body_class(); ?>>
	<?php ie_browse_happy(); ?>
		<header id="header">
			<div id="masthead">
				<div id="branding" role="banner">
					<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
					<<?php echo $heading_tag; ?> id="site-title">
						<span>
							<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</span>
					</<?php echo $heading_tag; ?>>
					<div id="site-description"><?php bloginfo( 'description' ); ?></div>

					<?php
						// Compatibility with versions of WordPress prior to 3.4.
						if ( function_exists( 'get_custom_header' ) ) {
							// We need to figure out what the minimum width should be for our featured image.
							// This result would be the suggested width if the theme were to implement flexible widths.
							$header_image_width = get_theme_support( 'custom-header', 'width' );
						} else {
							$header_image_width = HEADER_IMAGE_WIDTH;
						}

						// Check if this is a post or page, if it has a thumbnail, and if it's a big one
						if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
								has_post_thumbnail( $post->ID ) &&
								( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
								$image[1] >= $header_image_width ) :
							// Houston, we have a new header image!
							echo get_the_post_thumbnail( $post->ID );
						elseif ( get_header_image() ) :
							// Compatibility with versions of WordPress prior to 3.4.
							if ( function_exists( 'get_custom_header' ) ) {
								$header_image_width  = get_custom_header()->width;
								$header_image_height = get_custom_header()->height;
							} else {
								$header_image_width  = HEADER_IMAGE_WIDTH;
								$header_image_height = HEADER_IMAGE_HEIGHT;
							}
						?>
							<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
						<?php endif; ?>
				</div><!-- #branding -->

				<nav id="access" role="navigation">
				  <?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
					<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
					<?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
					<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #access -->
			</div><!-- #masthead -->
		</header><!-- #header -->
		<main class="content" role="main">
