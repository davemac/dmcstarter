<?php

// head cleanup, post and image related cleaning
require_once get_template_directory() . '/lib/clean.php';

// enqueue vendor scripts and styles
require_once get_template_directory() . '/lib/enqueue.php';

// load Foundation specific functions eg top-bar
require_once get_template_directory() . '/lib/foundation.php';

// filter default WordPress menu classes, add Foundation classes and clean wp_nav_menu markup
require_once get_template_directory() . '/lib/nav.php';

/* Custom post types */
// require_once get_template_directory() . '/post-types/dmc-staff.php';
// require_once get_template_directory() . '/post-types/dmc-courses.php';

/* Custom taxonomies */
// require_once get_template_directory() . '/taxonomies/coursecat.php';
// require_once get_template_directory() . '/taxonomies/coursevenue.php';

// Advanced Custom Fields customisation functions
require_once get_template_directory() . '/lib/acf-functions.php';
// require_once get_template_directory() . '/lib/acf/acf_form_user.php';

// Widgets setup
require_once get_template_directory() . '/lib/widgets.php';

// pagination
require_once get_template_directory() . '/lib/pagination.php';
require_once get_template_directory() . '/lib/prev-next.php';

// post meta functions (entry meta, post authors etc)
require_once get_template_directory() . '/lib/post-meta.php';

// hero image functions
require_once get_template_directory() . '/lib/hero-images.php';

// slider function
require_once get_template_directory() . '/lib/sliders.php';

// email functions
require_once get_template_directory() . '/lib/email.php';

// video functions
require_once get_template_directory() . '/lib/video.php';

// calls to action
require_once get_template_directory() . '/lib/calls-to-action.php';

// pre_get_posts query modification functions
// require_once get_template_directory() . '/lib/query-mods.php';

// sideload images from a directory or URLs
// require_once get_template_directory() . '/lib/dmc-sideload-featured-img.php';

// set post terms from a CSV file
// require_once get_template_directory() . '/lib/dmc-set-post-terms.php';

// Jetpack customisation functions
require_once get_template_directory() . '/lib/jetpack.php';

// jetpack-testimonials post-type and ACF customisation and display functions
require_once get_template_directory() . '/lib/jetpack-testimonials.php';

// WooCommerce customisation functions
// require_once get_template_directory() . '/lib/woocommerce/woocommerce.php';

// Gravity Forms customisation functions
// require_once get_template_directory() . '/lib/gravity-forms.php';

// wp-admin user profile customisation functions
// require_once get_template_directory() . '/lib/user-profile.php';

// ACF content blocks page builder
// require_once get_template_directory() . '/lib/content-blocks.php';

// Tracking pixels
// require_once get_template_directory() . '/lib/tracking/dmc-linkedin-pixel.php';
// require_once get_template_directory() . '/lib/tracking/dmc-facebook-pixel.php';
// require_once get_template_directory() . '/lib/tracking/dmc-gtm.php';

// RSS customisation functions
// require_once get_template_directory() . '/lib/rss.php';

// featured content
// require_once get_template_directory() . '/lib/dmc_display_featured_content.php';

// featured content cards
// require_once get_template_directory() . '/lib/dmc-display-content-type-cards.php';
