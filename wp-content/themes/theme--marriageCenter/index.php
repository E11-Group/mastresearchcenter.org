<?php
// use Modules\CTA;


### Critical CSS for the main archive template
// taoti_enqueue_critical_css( get_template_directory().'/styles/css/critical/index-critical.min.css' );


get_header();
?>



<main class="main">
    <article class="l-container">
        <div class="breadcrumbs">
            <?php echo do_shortcode('[flexy_breadcrumb]'); ?>
        </div>
        <h1 class="main__title pageTitle"><?php the_title(); ?></h1>
    </article>

</main>


<?php
get_footer();
