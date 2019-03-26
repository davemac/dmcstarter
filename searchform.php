<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="single-field-search">
		<i class="fal fa-search"></i>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'dmcstarter' ); ?>">
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'dmcstarter' ); ?>">
	</div>
</form>


<!-- <div class="placeholder">
	<div class="expanding-sf">
		<div class="form"> <span class="toggle"></span>
			<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="text" placeholder="Search" id="s" name="s" value="">
				<div class="icn">
					<input type="submit" value="" id="searchsubmit">
				</div>
			</form>
		</div>
	</div>
</div> -->
