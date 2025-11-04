<?php if( adswth_option( 'spp_show_store_benefits' ) ) {
    $delivery_time = adswth_option( 'spp_store_benefits_delivery_time_text' );
    if($delivery_time){
        setlocale(LC_ALL, adswth_option('delivery_date_language'));
        define("CHARSET", "iso-8859-1");
        $delivery_date = utf8_encode(strftime ('%A, %B %e', strToTime('today + '.$delivery_time.' days')));
    }
    $benefits = adswth_option( 'spp_benefits_list' );
?>
    <div class="store-benefits-wrap">
        <?php if(!empty($benefits)){ ?>
            <div class="store-benefits d-block d-md-flex justify-content-between">
                <?php foreach($benefits as $key => $benefit){ ?>
                    <div class="benefit d-flex">
                        <?php if(!empty($benefit['spp_benefit_image'])){ ?>
                            <?php $icon = is_numeric( $benefit[ 'spp_benefit_image' ] ) ? wp_get_attachment_url( $benefit[ 'spp_benefit_image' ] ) : $benefit[ 'spp_benefit_image' ]; ?>
                            <div class="img">
                                <img src="<?php echo $icon?>" alt="<?php echo $benefit['spp_benefit_title']?>" />
                            </div>
                        <?php } ?>
                        <?php if(!empty($benefit['spp_benefit_title']) || !empty($benefit['spp_benefit_text'])){ ?>
                            <div class="text">
                                <?php if(!empty($benefit['spp_benefit_title'])){ ?>
                                    <div class="title">
                                        <?php echo $benefit['spp_benefit_title']?>
                                        <?php if(!empty($delivery_date) && $key == 0){ ?>
                                            <?php echo " " . $delivery_date; ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if(!empty($benefit['spp_benefit_text'])){ ?>
                                    <div class="description"><?php echo $benefit['spp_benefit_text']?></div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } //endif ?>
