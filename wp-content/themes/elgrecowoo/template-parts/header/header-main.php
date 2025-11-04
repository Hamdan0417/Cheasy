<div id="main-bar" class="header-main<?php //header_inner_class('main'); ?>">
    <div class="container px-xs-px-0">
        <div class="fw-block" data-sizes='["xs", "sm", "md", "lg"]'>
            <div class="fw-back">
                <div class="row align-items-center justify-content-between mx-xs-px-0 mx-sm-px-0 mx-md-px-0 mx-lg-px-0">
                    <div class="col-auto d-xl-none px-0"><button id="mobile-menu-switch" class="mobile-menu-switch d-block py-px-10 px-xs-px-10  px-sm-px-15 px-md-px-15 px-lg-px-15"><span></span><span></span><span></span></button></div>
                    <div class="col-auto col-xl-3">
                        <?php get_template_part( 'template-parts/header/partials/element-main', 'logo' ); ?>
                    </div>
                    <div class="col-auto">
                        <?php get_template_part( 'template-parts/header/partials/element-main', 'search' ); ?>
                    </div>
                    <div class="col-auto col-xl-3 d-flex justify-content-end align-items-center px-sm-px-0 px-xs-px-0">
                        <?php if( adswth_option( 'header_account_show' ) ){ ?>
                            <div class="col-auto d-none d-xl-block">
                                <?php get_template_part( 'template-parts/header/partials/element-top', 'account' ); ?>
                            </div>
                        <?php } //endif; ?>
                        <div class="col-auto d-none d-xl-block">
                            <?php get_template_part( 'template-parts/header/partials/element-top', 'currency-switcher' ); ?>
                        </div>
                        <div class="col-auto d-flex justify-content-end align-items-center">
                            <?php get_template_part( 'template-parts/header/partials/element-main', 'cart' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
