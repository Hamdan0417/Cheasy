<?php if( adswth_option( 'footer_absolute_show' ) ) { ?>
<div id="footer-absolute" class="footer-absolute">
	<div class="container">
		<?php if( !empty ( adswth_option( 'footer_absolute_text_primary' ) ) ) { ?>
		<div class="footer-absolute-primary">
			<?php echo adswth_option( 'footer_absolute_text_primary' ); ?>
		</div>
		<?php } //endif; ?>
		<?php if( !empty ( adswth_option( 'footer_absolute_text_secondary' ) ) ) { ?>
		<div class="footer-absolute-secondary">
			<?php echo adswth_option( 'footer_absolute_text_secondary' ); ?>
		</div>
		<?php } //endif; ?>
	</div>
</div>
<?php } //endif; ?>