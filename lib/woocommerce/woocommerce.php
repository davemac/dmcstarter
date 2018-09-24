<?php

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

require_once get_template_directory() . '/lib/woocommerce/global.php';

require_once get_template_directory() . '/lib/woocommerce/layout.php';

require_once get_template_directory() . '/lib/woocommerce/category.php';

// User account customisations
require_once get_template_directory() . '/lib/woocommerce/account.php';

// Cart customisations
require_once get_template_directory() . '/lib/woocommerce/cart.php';

// Order customisations
// require_once get_template_directory() . '/lib/woocommerce/orders.php';

