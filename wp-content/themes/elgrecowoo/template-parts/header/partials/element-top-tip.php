<?php if( adswth_option( 'header_tip_show' ) ){ ?>
	<div class="ship-tip-wrap">
		<div class="ship-tip">
			<?php
            $icon = '';

			if( adswth_option( 'header_tip_icon_custom' ) ){
			    if( adswth_option( 'header_tip_icon' ) ){
				    $icon = '<img src="' . adswth_option( 'header_tip_icon' ) . '" />' . "&nbsp;";
			    }
			}else{
				$icon = '<i class="icon-flight"></i>' . "&nbsp;";
			}
			?>
			<?php echo $icon; ?><span><?php echo adswth_option( 'header_tip_text' ); ?></span>
		</div>
	</div>
<?php } //endif; } ?>