<?php
$classes   = [];
$classes[] = adswth_option( 'back_to_top_position' ) === 'left' ? 'left' : '';
$classes[] = adswth_option( 'back_to_top_mobile' ) ? '' : 'hidden-xs';

$classes = implode( ' ', array_filter( $classes ) );
?>
<?php if( adswth_option( 'back_to_top_show' ) ) { ?>
<div id="back-to-top" class="back-to-top <?php echo $classes; ?>"><i class="icon-arrow-up"></i></div>
<?php } //endif ?>