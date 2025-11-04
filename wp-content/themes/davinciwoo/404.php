<?php
/**
 * The template for 404.
 */

get_header();
do_action( 'adswth_before_page' ); ?>

	<div class="container d-flex w-100">
		<div id="content" class="content-area page-wrapper d-flex w-100" role="main">
			<div class="fw-block d-flex w-100">
				<div class="fw-back" style="background-image: url(<?php echo adswth_option( '404_background_image' ); ?>)"></div>
				<div class="fw-inner align-items-center justify-content-center d-flex w-100">
					<div class="py-px-60 text-center mt-px-20">
						<h1 class="page-title text-white "><?php _e( '404', 'davinciwoo'); ?></h1>
						<div class="text font-16 text-white"><?php echo adswth_option( '404_text' ); ?></div>

							<?php
							$btn_1_label = adswth_option( '404_btn_text_1' );
							$btn_1_url = adswth_option( '404_btn_link_1' );
							$btn_2_label = adswth_option( '404_btn_text_2' );
							$btn_2_url = adswth_option( '404_btn_link_2' );
							?>
							<?php if( !empty( $btn_1_label ) && !empty( $btn_1_url ) || !empty( $btn_2_label ) && !empty( $btn_2_url ) ) { ?>
								<div class="buttons mt-px-20">
									<?php if( !empty( $btn_1_label ) && !empty( $btn_1_url ) ) { ?>
										<a href="<?php echo $btn_1_url; ?>" class="btn btn-white mt-xs-px-15"><?php echo $btn_1_label; ?></a>
									<?php } //endif; ?>
									<?php if( !empty( $btn_2_label ) && !empty( $btn_2_url ) ) { ?>
										<a href="<?php echo $btn_2_url; ?>" class="btn btn-transparent mt-xs-px-15"><?php echo $btn_2_label; ?></a>
									<?php } //endif; ?>
								</div>
							<?php } //endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php

do_action( 'adswth_after_page' );
get_footer();
