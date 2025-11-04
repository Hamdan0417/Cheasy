<?php
$val_mob = adswth_option( 'woo_product_cat_mob' );
$val_tab = adswth_option( 'woo_product_cat_tab' );
$colClass = "col col-lg-3";
switch($val_mob){
    case 3:
        $colClass .= " col-4 col-sm three-per-row";
        break;
    case 2:
        $colClass .= " col-6 col-sm two-per-row";
        break;
    default:
        $colClass .= " col-12";
}
switch($val_tab){
    case 4:
        $colClass .= " col-md-3 md-four-per-row";
        break;
    case 3:
        $colClass .= " col-md-4 md-three-per-row";
        break;
    case 2:
        $colClass .= " col-md-6 md-two-per-row";
        break;
    default:
        $colClass .= " col-md-12";
}
?>

<div class="<?php echo $colClass; ?> product-cat-wrap">
	<?php wc_get_template_part( 'content', 'product' ); ?>
</div>
