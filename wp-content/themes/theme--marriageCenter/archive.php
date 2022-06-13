<?php
// use Modules\CTA;

$post_object = get_post_type_object(get_post_type());
$queried_object = get_queried_object();
get_header();
?>



<main class="main">
    <article class="l-container">
        <div class="breadcrumbs">
            <?php echo do_shortcode('[flexy_breadcrumb]'); ?>
        </div>
        <?php
			//get the category for the archive page
			$category = get_the_category();
			$current_category = $category[0];
        ?>
        <h1 class="main__title pageTitle">
            <?php if(ucfirst($current_category->name)): ?>
                <?php echo ucfirst($current_category->name); ?>
            <?php elseif(isset($queried_object->name)): ?>
                <?php echo $queried_object->name; ?>
            <?php endif; ?>
        </h1>
    </article>

<?php
	$category_id = $current_category->term_id;

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args = array(
	    'post_type' => 'post',
	    'posts_per_page' => 8,
	    'status' => 'published',
	    'paged' => $paged,
	    'cat' => $category_id
	);
	$the_query = new WP_Query( $args ); ?>

	<?php if ( $the_query->have_posts() ) : ?>

    <section class="">
        <div class="l-container">
            <div class="cards__row flexRow">
			    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			        <?php
			        $tagArgs = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
			        $tags = wp_get_post_terms( get_the_id(), 'category', $tagArgs );
			        ?>
			        <div class="card card--blue">
			            <div class="card__inner">
			                <?php
			                if(has_post_thumbnail()){
			                    $cardImage = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
			                    $cardImage = $cardImage[0];
			                }
			                ?>
			                <div class="card__image" <?php if($cardImage):?> style="background-image: url(<?php echo $cardImage; ?>)"<?php endif; ?>></div>
			                <div class="card__contentWrap">
			                    <h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                    <span class="card__date">Published <?php echo get_the_date('F j, Y'); ?></span>
			                    <div class="card__content"><?php the_excerpt(); ?></div>
			                </div>
			            </div>
			        </div>
			    <?php endwhile; ?>
			</div>

			<div class="pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="pagination-arrow pagination-arrow-left"></i>',
                    'next_text' => '<i class="pagination-arrow pagination-arrow-right"></i>',
                    'screen_reader_text' => null
                ) );
                ?>
			</div>
		    <?php wp_reset_postdata(); ?>
		</div>
	</section>

	<?php endif; ?>

</main>


<?php
get_footer();
