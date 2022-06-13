<?php
// use Modules\CTA;


### Critical CSS for the default page template
// taoti_enqueue_critical_css( get_template_directory().'/styles/css/critical/page-critical.min.css' );


get_header();

?>

<main class="main">
    <article class="l-container">
        <div class="breadcrumbs">
            <?php echo do_shortcode('[flexy_breadcrumb]'); ?>
        </div>
        <h1 class="main__title pageTitle">404 Error: Page not found</h1>
        <div class="main__content entryContent">The page you are looking for has been moved or has been deleted.</div>
    </article>

    <?php the_page_builder(); ?>
</main>

<?php
get_footer();
