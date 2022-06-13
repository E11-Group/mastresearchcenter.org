<?php get_header(); ?>

<div class="main main--bbpress">
    <div class="l-container">
        <?php $disputo_bbpress_topic_sidebar = get_theme_mod('disputo_bbpress_topic_sidebar', 1); ?>
        <?php $disputo_bbpress_search_sidebar = get_theme_mod('disputo_bbpress_search_sidebar', 1); ?>
        <?php $disputo_bbpress_search = get_theme_mod('disputo_bbpress_search'); ?>
        <div id="header-wrapper">
            <header>
                <?php get_template_part( 'templates/header', 'template'); ?>
            </header>
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'templates/bbpresscover', 'template'); ?>
            <?php if (get_the_title()) { ?>
            <div class="disputo-page-title">
                <div class="container">
                    <?php bbp_breadcrumb(); ?>
                    <?php the_title('<h1>','</h1>'); ?>
                    <?php if (bbp_is_single_forum()) { ?>
                    <p><?php bbp_forum_content( get_the_id() ); ?></p> 
                    <?php } ?>
                    <?php if ( ($disputo_bbpress_search && !bbp_is_single_user()) || (bbp_allow_search() && bbp_is_search()) ) { ?>
                    <div id="disputo-header-search">
                    <?php get_template_part( 'templates/bbpresslg', 'template'); ?>
                    </div>
                    <?php } ?> 
                </div>
            </div>
            <?php } ?>
        </div>
        <main class="disputo-main-container">
            <div class="container">
            <div id="disputo-main-inner">
                <?php if ((bbp_is_single_topic()) && ($disputo_bbpress_topic_sidebar) && (is_active_sidebar( 'disputo_bbpress_topic_sidebar' ))) { ?>
                <div class="disputo-page-left"> 
                <?php } ?>
                <?php if ((bbp_is_search()) && ($disputo_bbpress_search_sidebar) && (is_active_sidebar( 'disputo_bbpress_search_sidebar' ))) { ?>
                <div class="disputo-page-left"> 
                <?php } ?>
                <?php if(!is_user_logged_in()): ?>
                    <section class="bbpresFormActions">
                        <div class="bbpresFormActions__row">
                            <div class="bbpresFormActions__register bbpresFormActions__item">
                                <div class="bbpresFormActions__item__inner">
                                    <h2>Register</h2>
                                    <?php echo do_shortcode('[user_registration_form id="205"]'); ?>
                                </div>
                            </div>
                            <div class="bbpresFormActions__login bbpresFormActions__item"><div class="bbpresFormActions__item__inner"><?php echo do_shortcode('[bbp-login]'); ?></div></div>
                        </div>
                    </section>
                <?php else: ?>
                    <?php the_content(); ?>

                    <?php if ((bbp_is_single_topic()) && ($disputo_bbpress_topic_sidebar) && (is_active_sidebar( 'disputo_bbpress_topic_sidebar' ))) { ?>
                    </div>
                        <aside class="disputo-page-right">
                            <?php dynamic_sidebar( 'disputo_bbpress_topic_sidebar' ); ?>
                        </aside>
                    <?php } ?> 
                    <?php if ((bbp_is_search()) && ($disputo_bbpress_search_sidebar) && (is_active_sidebar( 'disputo_bbpress_search_sidebar' ))) { ?>
                    </div>
                        <aside class="disputo-page-right">
                            <?php dynamic_sidebar( 'disputo_bbpress_search_sidebar' ); ?>
                        </aside>
                    <?php } ?>
                <?php endif; ?>

               

            </div>
            </div>
        </main>
    </div>
</div>
<?php endwhile; ?> 
<?php get_footer(); ?>