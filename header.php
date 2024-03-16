<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sanev_WooCommerce
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sanev_woocommerce' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="d-flex row align-center justify-between site-branding">
			<div class="bg-primary p-4">
				<?php
				the_custom_logo();
				?>
			</div>
			<div>
				<nav id="site-navigation" class="main-navigation pr-4">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->
	<button 
	id="theme-toggler" 
	class="cursor-pointer bg-secondary white" 
	aria-pressed="false"
	>theme toggler</button>
