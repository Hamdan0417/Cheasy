<?php
// Default checkout layout
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php wc_get_template( 'checkout/header.php' ); ?>

	<div class="checkout-content mt-px-15">

	<?php wc_print_notices(); ?>

	<?php the_content(); ?>

	</div>

	<?php wc_get_template( 'checkout/footer.php' ); ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>