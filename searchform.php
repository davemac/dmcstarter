<form role="search" method="get" id="searchform" class="hide-for-medium-down" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="single-field-search">
		<i class="fal fa-search"></i>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'dmcstarter' ); ?>">
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'dmcstarter' ); ?>">
	</div>
</form>


<!-- <div class="search-container">
	<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input class="search expandright" id="searchright" type="search" id="s" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search">
		<label class="searchbutton" for="searchright">
			<span class="mglass">&#9906;</span>
		</label>
		<input type="submit" value="<?php esc_attr_e( 'Search', 'dmcstarter' ); ?>" id="searchsubmit">
	</form>
</div> -->
