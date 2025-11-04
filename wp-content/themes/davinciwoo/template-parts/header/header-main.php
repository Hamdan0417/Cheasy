<div id="main-bar" class="header-main<?php //header_inner_class('main'); ?>">
    <div class="container px-xs-px-0">
        <div class="fw-block" data-sizes='["xs", "sm", "md", "lg"]'>
            <div class="fw-back">
                <div class="row align-items-center justify-content-between justify-content-md-start justify-content-xl-between mx-xs-px-0 mx-sm-px-0 mx-md-px-0 mx-lg-px-0">
                    <div class="col-auto d-xl-none px-0"><button id="mobile-menu-switch" class="mobile-menu-switch d-block py-px-10 px-xs-px-10  px-sm-px-15 px-md-px-15 px-lg-px-15"><span></span><span></span><span></span></button></div>
                    <div class="col-auto col-xl-3 py-1">
                        <?php get_template_part( 'template-parts/header/partials/element-main', 'logo' ); ?>
                    </div>
                    <div class="col-xl-5 d-none d-xl-block">
                        <?php get_template_part( 'template-parts/header/partials/element-main', 'search' ); ?>
                    </div>
                    <div class="col-auto ml-auto ml-xl-0 col-xl-2 d-none d-md-block">
                        <?php get_template_part( 'template-parts/header/partials/element-main', 'contact' ); ?>
                    </div>
                    <div class="col-auto col-xl-2 d-flex justify-content-end">
                        <?php get_template_part( 'template-parts/header/partials/element-main', 'cart' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
