<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ambrotype201
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
// metahead description
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ambrotype201' ); ?></a>
		<header id="masthead" class="site-header">
			<div class="site-branding">
			<?php the_custom_logo(); ?>
			</div><!-- .site-branding -->
		
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fas fa-bars"></i></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
				) );
				?>
				
				<?php
		if ( function_exists( 'ambrotype201_woocommerce_header_cart' ) ) {
			ambrotype201_woocommerce_header_cart();
		}?>
			</nav><!-- #site-navigation -->
			
		</header><!-- #masthead -->

	<div id="content" class="site-content">
