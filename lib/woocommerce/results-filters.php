<section class="search-filter">
	<ul class="flex-row prod-filters">
		<li class="filter-item">
			<form id="application-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<?php
				$product_cat_id = null;
				$product_object = get_queried_object();
				if ( isset( $product_object->term_id ) ) {
					$product_cat_id = $product_object->term_id;
				}

				$args = array(
					'show_option_none' => __( 'Applications' ),
					// 'show_count'       => 1,
					'orderby'          => 'name',
					'taxonomy'         => 'product_cat',
					'value_field'      => 'slug',
					'name'             => 'product_cat',
					'child_of'         => 16,
					'echo'             => 0,
				);

				$select_application = wp_dropdown_categories( $args );
				$replace        = "<select$1 onchange='return this.form.submit()'>";
				$select_application = preg_replace( '#<select([^>]*)>#', $replace, $select_application );

				echo $select_application;
				?>

				<noscript>
					<input type="submit" value="View Applications" />
				</noscript>
			</form>
		</li>

		<li class="filter-item">
			<form id="range-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<?php

				$args = array(
					'show_option_none' => __( 'Ranges' ),
					// 'show_count'       => 1,
					'orderby'          => 'name',
					'taxonomy'         => 'product_cat',
					'value_field'      => 'slug',
					'name'             => 'product_cat',
					'child_of'         => 23,
					'echo'             => 0,
				);

				$select_range = wp_dropdown_categories( $args );
				$replace        = "<select$1 onchange='return this.form.submit()'>";
				$select_range = preg_replace( '#<select([^>]*)>#', $replace, $select_range );

				echo $select_range;
				?>

				<noscript>
					<input type="submit" value="View Range" />
				</noscript>
			</form>
		</li>

		<li class="filter-item">
			<form id="purpose-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<?php

				$args = array(
					'show_option_none' => __( 'Purposes' ),
					// 'show_count'       => 1,
					'orderby'          => 'name',
					'taxonomy'         => 'product_cat',
					'value_field'      => 'slug',
					'name'             => 'product_cat',
					'child_of'         => 28,
					'echo'             => 0,
				);

				$select_purpose = wp_dropdown_categories( $args );
				$replace        = "<select$1 onchange='return this.form.submit()'>";
				$select_purpose = preg_replace( '#<select([^>]*)>#', $replace, $select_purpose );

				echo $select_purpose;
				?>

				<noscript>
					<input type="submit" value="View Purposes" />
				</noscript>
			</form>
		</li>
	</ul>
</section>
