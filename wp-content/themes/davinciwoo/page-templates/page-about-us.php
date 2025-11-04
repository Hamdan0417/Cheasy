<?php
/*
 * Template name: About Us
 */

get_header();
do_action( 'adswth_before_page' ); ?>

	<div class="container mt-px-20 ">
		<div id="content" class="content-area page-wrapper page-about-us" role="main">
			<?php adswth_breadcrumbs(); ?>

			<?php if( have_posts() ) { ?>

				<div class="row page-row justify-content-center">
					<div class="col-12">

						<?php while( have_posts() ) { the_post(); ?>
                            <div class="fw-block">
                                <div class="fw-back" style="background-image: url(<?php adswth_the_field( '_top_bg_about', 'about_us' ); ?>)"></div>
                                <div class="fw-inner text-white page-head-image">
                                    <h1 class="page-title"><?php the_title(); ?></h1>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8 col-lg-10">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if( adswth_get_field( '_our_core_values_show', 'about_us' ) ) { ?>
                            <div class="py-px-60 bens">

                                <h2 class="text-uppercase text-center mb-px-30"><?php adswth_the_field( '_our_core_values_title', 'about_us' ); ?></h2>
                                <div class="row justify-content-center">
                                    <div class="col-xl-10">
                                        <div class="about-slider row no-gutters row-slider lg-columns-5 md-columns-3 justify-content-center" data-flickity-options='{
                                                                  "cellAlign": "left",
                                                                  "wrapAround": false,
                                                                  "autoPlay": false,
                                                                  "prevNextButtons": false,
                                                                  "percentPosition": true,
                                                                  "imagesLoaded": true,
                                                                  "lazyLoad": 1,
                                                                  "pageDots": true,
                                                                  "contain": true,
                                                                  "watchCSS": true
                                                              }'>
                                            <?php for( $i = 1; $i <= 5; $i++ ){
                                                $image = adswth_get_field( '_our_core_values_img_' . $i, 'about_us' );
                                                $text = adswth_get_field( '_our_core_values_text_' . $i, 'about_us' );

                                                if( !empty( $image ) && !empty( $text ) ){ ?>
                                                    <div class="col bens-item px-0 my-md-px-15">
                                                        <div class="bens-iten-inner px-px-15">
                                                            <div class="image-wrap">
                                                                <img class="img-fluid" src="<?php echo $image; ?>" />
                                                            </div>
                                                            <div class="text font-16">
                                                                <?php echo $text; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                            } //endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } //endif; ?>

		                    <?php if( adswth_get_field( '_keep_in_contact_show', 'about_us' ) ) { ?>
                            <div class="fw-block" id="keep-in-contact">
                                <div class="fw-back bg-white"></div>
                                <div class="fw-inner py-px-60">
                                    <h2 class="text-uppercase text-center mb-px-30"><?php adswth_the_field( '_keep_in_contact_title', 'about_us' ); ?></h2>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8 col-lg-10 font-16 text-center">
	                                        <?php adswth_the_field( '_keep_in_contact_description', 'about_us' ); ?>
                                        </div>
                                        <?php
                                            $btn_1_label = adswth_get_field( '_keep_in_contact_btn_1_label', 'about_us' );
                                            $btn_1_url = adswth_get_field( '_keep_in_contact_btn_1_url', 'about_us' );
                                            $btn_2_label = adswth_get_field( '_keep_in_contact_btn_2_label', 'about_us' );
                                            $btn_2_url = adswth_get_field( '_keep_in_contact_btn_2_url', 'about_us' );
                                        ?>
                                        <?php if( !empty( $btn_1_label ) && !empty( $btn_1_url ) || !empty( $btn_2_label ) && !empty( $btn_2_url ) ) { ?>
                                        <div class="col-xl-8 col-lg-10 text-center mt-px-30">
                                            <?php if( !empty( $btn_1_label ) && !empty( $btn_1_url ) ) { ?>
                                                <a href="<?php echo $btn_1_url; ?>" class="btn btn-secondary"><?php echo $btn_1_label; ?></a>
                                            <?php } //endif; ?>
                                            <?php if( !empty( $btn_2_label ) && !empty( $btn_2_url ) ) { ?>
                                                <a href="<?php echo $btn_2_url; ?>" class="btn btn-white-bordered"><?php echo $btn_2_label; ?></a>
                                            <?php } //endif; ?>
                                        </div>
                                        <?php } //endif; ?>
                                    </div>
                                </div>
                            </div>
							<?php } //endif; ?>

							<?php if( adswth_get_field( '_our_partners_show', 'about_us' ) ) { ?>
                                <div class="py-px-60">
                                    <h2 class="text-uppercase text-center mb-px-30"><?php adswth_the_field( '_our_partners_title', 'about_us' ); ?></h2>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8 col-lg-10 font-16 text-center">
                                            <?php adswth_the_field( '_our_partners_description', 'about_us' ); ?>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-px-15">
		                                <?php for( $i = 1; $i <= 5; $i++ ){
			                                $image = adswth_get_field( '_about_delivery_' . $i, 'about_us' );

			                                if( !empty( $image ) ){ ?>
                                                <div class="col-auto mt-px-15">
                                                    <img class="img-fluid" src="<?php echo $image; ?>" />
                                                </div>
			                                <?php }
		                                } //endfor; ?>
                                    </div>
                                </div>
							<?php } //endif; ?>
						<?php } //endwhile; ?>

					</div>
				</div>

			<?php } //endif; ?>

		</div>
	</div>
<?php

do_action( 'adswth_after_page' );
get_footer();
