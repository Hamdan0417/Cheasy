<div id="top-bar" class="header-top <?php //header_inner_class('top'); ?>">
	<div class="container">
        <div class="fw-block" data-sizes='["xs", "sm", "md", "lg"]'>
            <div class="fw-back">
                <div class="row justify-content-between mx-xs-px-0 mx-sm-px-0 mx-md-px-0 mx-lg-px-0">
                    <div class="d-none d-xl-block col-auto top-bar-left">
                        <?php if ( has_nav_menu('top_menu' ) ) { ?>
                        <div class="topmenu-wrap">
                            <ul class="topmenu">
                            <?php wp_nav_menu( [
                                'menu'           => __( 'Top Menu', 'davinciwoo' ),
                                'theme_location' => 'top_menu',
                                'depth'          => 0,
                                'container'      => false,
                                'items_wrap'     => '%3$s',
                                'walker'         => new \adswth\walker\adsMenuDropdown()
                            ] ); ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-xl-auto top-bar-right">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <?php get_template_part( 'template-parts/header/partials/element-top', 'tip' ); ?>
                            </div>
                            <div class="col-auto d-none d-xl-block">
                                <?php get_template_part( 'template-parts/header/partials/element-top', 'currency-switcher' ); ?>
                            </div>

                            <?php if( adswth_option( 'header_account_show' ) ){ ?>
                            <div class="col-auto d-none d-xl-block">
                                <?php get_template_part( 'template-parts/header/partials/element-top', 'account' ); ?>
                            </div>
                            <?php } //endif; ?>
                            <div class="col-auto d-xl-none">
                                <div class="mobile-search-switch">
                                    <i class="icon-search"></i>
                                </div>
                            </div>
                            <div class="mobile-search d-xl-none" style="display: none;">
		                        <?php get_template_part( 'template-parts/header/partials/element-main', 'search' ); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
	</div>
</div>