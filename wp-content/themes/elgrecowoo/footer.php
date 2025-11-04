        </main><!-- #main -->

        <?php if( is_product() || is_product_category() ||  is_front_page() || is_shop()){ ?>
            <?php get_template_part('template-parts/footer/footer', 'store-features'); ?>
        <?php } ?>

        <?php do_action('adswth_after_main' ); ?>

        <footer id="footer" class="footer-wrapper">
            <div class="footer-widgets-area">
                <?php get_template_part('template-parts/footer/footer'); ?>
            </div>
            <?php get_template_part('template-parts/footer/footer', 'absolute'); ?>

        </footer><!-- .footer-wrapper -->

        <?php get_template_part('template-parts/footer/back-to-top'); ?>

    </div><!-- #wrapper -->
    <div class="shade"></div>
<?php wp_footer(); ?>

<?php echo adswth_option( 'additional_footer_scripts' ); ?>

</body>
</html>