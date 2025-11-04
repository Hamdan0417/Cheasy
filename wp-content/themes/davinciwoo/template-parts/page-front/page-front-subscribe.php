<?php if( adswth_option( 'subscribe_block_show' ) && !empty( adswth_option( 'subscribe_code' ) ) ){ ?>
	<div id="subscribe-form-block">
		<div class="container">
			<div class="subscribe-form-wrap">
                <?php echo adswth_option( 'subscribe_code' );?>
			</div>
		</div>
	</div>
<?php } //endif;?>