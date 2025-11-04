<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 12:56
 *
 * Blog footer
 */
?>

        </main><!-- #main -->

        <?php do_action('adswth_after_main' ); ?>

        <footer id="footer-blog" class="footer-blog">

            <?php get_template_part('blog/template-parts/partials/footer', 'main'); ?>

        </footer><!-- .footer-wrapper -->

        <?php get_template_part('blog/template-parts/footer/back-to-top'); ?>

    </div><!-- #wrapper -->

<?php wp_footer(); ?>

<?php echo adswth_option( 'additional_footer_scripts' ); ?>

</body>
</html>