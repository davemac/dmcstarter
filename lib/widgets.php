<?php

add_action( 'widgets_init', 'dmc_register_sidebars' );
function dmc_register_sidebars() {

	register_sidebar(
		array(
			'name'          => 'Homepage sidebar',
			'id'            => 'sidebar-home',
			'description'   => 'Widgets placed here will appear on the homepage',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'About Us sidebar',
			'id'            => 'sidebar-about',
			'description'   => 'Widgets placed here will appear in the sidebar on the About Us page',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Courses & Training sidebar',
			'id'            => 'sidebar-courses',
			'description'   => 'Widgets placed here will appear in the sidebar on the Courses & Training page',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Blog sidebar',
			'id'            => 'sidebar-news',
			'description'   => 'Widgets placed here will appear in the sidebar on Blog pages',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Shop sidebar',
			'id'            => 'sidebar-shop',
			'description'   => 'Widgets placed here will appear in the sidebar on Shop pages',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Contact sidebar',
			'id'            => 'sidebar-contact',
			'description'   => 'Widgets placed here will appear in the sidebar on the Contact page',
			'before_widget' => '<section id="%1$s" class="panel widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

}
