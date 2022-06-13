<?php
// use Modules\CTA;



### Critical CSS for the default page template
// taoti_enqueue_critical_css( get_template_directory().'/styles/css/critical/page-critical.min.css' );


get_header();

the_post();
?>

<main class="main">
    <article class="l-container">
        <div class="breadcrumbs">
            <?php echo do_shortcode('[flexy_breadcrumb]'); ?>
        </div>
        <h1 class="main__title pageTitle"><?php the_title(); ?></h1>
        <div class="main__content entryContent"><?php the_content(); ?></div>
    </article>

    <?php the_page_builder(); ?>
</main>



<?php get_footer();