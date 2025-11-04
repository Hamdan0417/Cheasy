<?php
// Get Header Top template. Located in template-parts/header/header-top.php
get_template_part('template-parts/header/header','top');

// Get Header Main template. Located in template-parts/header/header-main.php
get_template_part('template-parts/header/header', 'main');

// Header Backgrounds
echo '<div class="header-bg-container fill">';
do_action('adswth_header_background');
echo '</div><!-- .header-bg-container -->';

do_action('adswth_header_wrapper');