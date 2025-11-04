<?php if( is_adsw_activated() ){

    global $wp;

    $currency = adsw_define_currency();

	if( $currency['cur_enable'] && adswth_option( 'header_currency_switcher_show' ) ){ ?>
		<div class="header-currency-switcher-wrap">
            <?php
            $currencies = adsw_get_active_currencies();
            $current_currency = adsw_get_active_currency();
            ?>
            <div class="header-currency-switcher dropdown-currency">
                <a class="current-currency dropdown-toggle"
                    <?php if( ! empty( $currencies ) && count( $currencies ) > 1 ){ echo 'data-toggle="dropdown"'; } ?>
                   href="#"
                   aria-expanded="false"
                   aria-haspopup="true"
                   role="button"
                   data-code="<?php echo $current_currency[ 'code' ]; ?>">

                    <span class="flag <?php echo $current_currency[ 'flag' ] != '' ? 'flag-'.$current_currency[ 'flag' ] : 'flag-empty'; ?>"></span>
                    <span class="code">(<?php echo $current_currency[ 'code' ]; ?>)</span>
                    <span class="symbol"><?php echo $current_currency[ 'symbol' ]; ?></span>
                    <?php if( ! empty( $currencies ) && count( $currencies ) > 1 ) { ?>
                    <i class="icon-down-open align-middle"></i>
                    <?php } ?>
                </a>
                <?php if( ! empty( $currencies ) && count( $currencies ) > 1 ){ ?>
                <ul class="dropdown-menu currency-list" >
	                <?php foreach ( $currencies as $item ) {
	                    if( $item[ 'code' ] == $current_currency[ 'code' ] ) continue;
		                $url = home_url( add_query_arg( [ 'cur' => strtolower( $item[ 'code' ] ) ], $wp->request ) );
		                $info = adsw_get_currency_info( $item[ 'code' ] );
	                ?>
                    <li class="dropdown-item">
                        <a href="<?php echo $url; ?>" class="currency-item" data-code="<?php echo $item[ 'code' ]; ?>">
                            <span class="flag <?php echo $item[ 'flag' ] != '' ? 'flag-'.$item[ 'flag' ] : 'flag-empty'; ?>"></span>
                            <span class="code"><?php echo $info['title'] ?></span>
                        </a>
                    </li>
                    <?php } //endforeach; ?>
                </ul>
                <?php } //endif; ?>
            </div>
	    </div>
    <?php }
}
?>