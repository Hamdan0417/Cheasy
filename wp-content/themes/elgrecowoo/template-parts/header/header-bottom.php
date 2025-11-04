<?php if ( has_nav_menu('top_menu' ) ) { ?>
    <div id="bottom-bar" class="header-bottom d-none d-xl-block">
        <div class="container">
            <div class="header-category-menu-wrap">
                <ul class="header-category-menu justify-content-between">
                    <?php wp_nav_menu( [
                        'menu'           => __( 'Top Menu', 'elgrecowoo' ),
                        'theme_location' => 'top_menu',
                        'depth'          => 4,
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        //'walker'         => new \adswth\walker\adsMenuDropdown()
                    ] ); ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>