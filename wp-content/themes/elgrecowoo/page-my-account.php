<?php
/**
 * The default template for displaying pages.
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

                            <h1 class="page-title"><?php the_title(); ?></h1>

							<div class="page-content">

								<?php the_content() ?>

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
