<?php
/**
 * User: Denis Zharov
 * Date: 17.09.2018
 * Time: 12:56
 *
 * Blog header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>


    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>

    <?php echo adswth_option( 'additional_header_scripts' ); ?>
    <?php do_action('ads_head_addons'); ?>

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
</head>
<?php $body_class = ['blog', 'js-items-lazy-load'] ?>
<body <?php body_class( $body_class ); ?>>

    <div id="wrapper">

        <?php do_action('adswth_before_blog_header'); ?>
        <header id="header-blog" class="header-blog <?php //adswth_header_classes();  ?>">
            <div class="header-wrapper">
                <?php get_template_part('blog/template-parts/header'); ?>
            </div><!-- header-wrapper-->
        </header>
        <?php do_action('adswth_after_blog_header'); ?>

        <main id="main" class="<?php //adswth_main_classes();  ?>">
