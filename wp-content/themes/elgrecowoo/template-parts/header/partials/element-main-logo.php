<?php
$logo = adswth_option('site_logo');
$logo_alt = '';
if(is_array($logo)){
    $logo_url = $logo['url'];
    $logo_alt = get_post_meta( $logo['id'], '_wp_attachment_image_alt', true );
} else {
    $logo_url = $logo;
}
?>
<div class="site-logo-wrap d-flex align-items-center" >
    <a href="<?php echo home_url( '/' ); ?>"><img class="site-logo img-fluid" src="<?php echo $logo_url; ?>" alt="<?php echo $logo_alt;?>" /></a>
</div>