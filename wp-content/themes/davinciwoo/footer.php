<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 12:56
 */
?>

        </main><!-- #main -->

        <?php do_action('adswth_after_main' ); ?>

        <footer id="footer" class="footer-wrapper">
            <div class="footer-widgets-area">
                <?php get_template_part('template-parts/footer/footer'); ?>
            </div>
            <?php get_template_part('template-parts/footer/footer', 'absolute'); ?>

        </footer><!-- .footer-wrapper -->

        <?php get_template_part('template-parts/footer/back-to-top'); ?>

    </div><!-- #wrapper -->

<?php wp_footer(); ?>

<?php echo adswth_option( 'additional_footer_scripts' ); ?>

</body>
</html>