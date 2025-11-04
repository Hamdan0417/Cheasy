<div class="container mt-px-30 mb-px-40">
    <div id="content" class="content-area page-wrapper" role="main">

        <div class="row page-row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <nav class="breadcrumbs checkout-breadcrumbs text-center">
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="<?php echo adswth_checkout_breadcrumb_class('cart'); ?>"><?php _e('Shopping Cart', 'davinciwoo'); ?></a>
                    <span class="mx-px-15"><i class="icon-right-open"></i></span>
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="<?php echo adswth_checkout_breadcrumb_class('checkout') ?>"><?php _e('Checkout details', 'davinciwoo'); ?></a>
                    <span class="mx-px-15"><i class="icon-right-open"></i></span>
                    <a href="#" class="no-click <?php echo adswth_checkout_breadcrumb_class('order-received'); ?>"><?php _e('Order Complete', 'davinciwoo'); ?></a>
                </nav>
                <hr />
            </div>
        </div>