<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row collapse">
		<div class="medium-8 small-9 columns">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'dmcstarter' ); ?>">
		</div>
		<div class="medium-4 small-3 columns">
			<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'dmcstarter' ); ?>" class="button postfix">
		</div>
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
