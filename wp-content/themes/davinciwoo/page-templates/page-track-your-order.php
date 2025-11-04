<?php
/**
 * Template name: Tracking
 */

get_header();
do_action( 'adswth_before_page' ); ?>

	<div class="container mt-px-20 mb-px-40">
		<div id="content" class="content-area page-wrapper" role="main">
			<?php adswth_breadcrumbs(); ?>

			<?php if( have_posts() ) { ?>

				<div class="row page-row justify-content-center">
					<div class="col-12">

						<?php while( have_posts() ) { the_post(); ?>

							<h1 class="page-title"><?php the_title() ?></h1>

							<div class="page-content">

								<?php the_content() ?>
								<div class="row justify-content-center">
									<div class="col-lg-8">
										<div class="trackform">
											<form action="" method="post" id="tracking-form" class="nicelabel">
												<div class="form-group is-empty d-flex justify-content-center">
													<input type="text" id="YQNum" class="form-control w-100  mr-md-2">
													<label for="YQNum" class="font-italic"><?php _e( 'Enter your tracking number', 'davinciwoo' ) ?></label>
													<button type="submit" class="btn btn-secondary">
														<span><?php _e( 'Search', 'davinciwoo' ) ?></span>
                                                        <i class="icon-right-open"></i>
													</button>
												</div>
											</form>
										</div>
									</div>
								</div>

								<div class="trackframe">
									<div id="YQContainer"></div>
                                </div>

							</div>

						<?php } //endwhile; ?>

					</div>
				</div>

			<?php } //endif; ?>

		</div>
	</div>
<?php

do_action( 'adswth_after_page' );
get_footer();
