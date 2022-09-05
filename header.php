<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- RSS Feed -->
	<link rel="alternate" type="application/rss+xml" title="<?php esc_html( bloginfo( 'name' ) ); ?> Feed" href="<?php echo esc_url( home_url() ); ?>/feed/">

	<?php wp_head(); ?>

</head>

<body <?php body_class( 'antialiased' ); ?>>

<?php wp_body_open(); ?>

<header class="contain-to-grid" id="header">

	<div class="brand-strip">

		<nav class="tab-bar show-for-small-only">
			<div class="right-small">
				<button class="menu-toggle left-off-canvas-toggle menu-icon" id="menu-toggle" aria-expanded="false">
					Menu
				</button>
			</div>
		</nav>

		<div class="sitename">
			<a href="#content" class="skiplink hide-for-small-only">
				Skip to main content
			</a>
			<?php
			the_custom_logo();
			?>
		</div>

		<div class="mainnav">
			<nav class="top-bar hide-for-small-only" data-topbar role="navigation">
				<section class="top-bar-section">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'depth'          => 3,
							'items_wrap'     => '<ul class="main-menu">%3$s</ul>',
						)
					);
					?>
				</section>
			</nav>
		</div>

		<?php
		require_once get_template_directory() . '/searchform.php';

		wp_nav_menu(
			array(
				'theme_location' => 'utility',
				'container'      => false,
				'depth'          => 1,
				'items_wrap'     => '<ul class="dmc-quicklinks">%3$s</ul>',
			)
		);

		// dmc_woocommerce_show_cart_indicator();
		?>

	</div>

</header>

<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">

<div class="container" role="document">

	<nav class="right-off-canvas-menu menu-hide" aria-hidden="true" role="off-canvas-navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'depth'          => 2,
				'items_wrap'     => '<ul class="off-canvas-list">%3$s</ul>',
			)
		);

		?>
	</nav>
	<a class="exit-off-canvas"></a>
