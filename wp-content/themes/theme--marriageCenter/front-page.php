<?php
// use Modules\CTA;

### Critical CSS for the front page template
taoti_enqueue_critical_css( get_template_directory().'/styles/css/critical/front-page-critical.min.css' );


get_header();
?>

<section class="homeSection homeSection--featuredCards featuredCardsWrap">
    <article class="l-container">
        <?php
        $featuredResources = get_field('featured_resources');
        $featuredResources = $featuredResources['featured_resources'];
        if($featuredResources): ?>
           <div class="featuredCards">
                <div class="featuredCards__row flexRow">
                    <?php foreach($featuredResources as $item): ?>
                        <?php
                        $post = $item['featured_resource'];
                        setup_postdata( $post );
                        $tagArgs = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                        $sources = wp_get_post_terms( get_the_id(), 'types', $tagArgs );
                        //$topics = wp_get_post_terms( get_the_id(), 'topics', $tagArgs );
                        $media_types = wp_get_post_terms( get_the_id(), 'media-types', $tagArgs );

                        $emerging_scholars = wp_get_post_terms( get_the_id(), 'emerging-scholars', $tagArgs );
                        $evaluation_design = wp_get_post_terms( get_the_id(), 'evaluation-design', $tagArgs );
                        $program_focus = wp_get_post_terms( get_the_id(), 'program-focus', $tagArgs );
                        $relationship_type = wp_get_post_terms( get_the_id(), 'relationship-type', $tagArgs );
                        $populations = wp_get_post_terms( get_the_id(), 'populations', $tagArgs );
                        $community_type = wp_get_post_terms( get_the_id(), 'community-type', $tagArgs );
                        $date = wp_get_post_terms( get_the_id(), 'date', $tagArgs );

                        $post_type_name = $post->post_type;

                        ?>
                        <div class="featuredCard">
                            <div class="featuredCard__inner">
                                <header class="featuredCard__header">
                                    <?php if($post_type_name == 'resources'){ ?>
                                        <span class="featuredCard__header__label">Featured Resource</span>
                                    <?php } elseif ($post_type_name == 'research') { ?>
                                        <span class="featuredCard__header__label">Featured MAST Center Research</span>
                                    <?php } ?>
                                    <span class="featuredCard__header__date"><?php the_date(); ?></span>
                                </header>
                                <?php if(has_post_thumbnail()): ?>
                                    <?php
                                    $featuredResourceImage = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
                                    $featuredResourceImage = $featuredResourceImage[0];
                                    ?>
                                    <div class="featuredCard__image" style="background-image: url(<?php echo $featuredResourceImage; ?>"></div>
                                <?php endif; ?>
                                <div class="featuredCard__contentWrap">
                                    <h2 class="featuredCard__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="featuredCard__content"><?php the_excerpt(); ?></div>
                                </div>
                                <?php
                                    $post_type = $post->post_type;

                                if($post_type == 'resources') { ?>
                                    <a href="<?php get_home_url(); ?>/evaluation-resource-library/" class="featuredCard__cta">See More Resources</a>
                                <?php } elseif($post_type == 'research') { ?>
                                    <a href="<?php get_home_url(); ?>/mast-center-research/" class="featuredCard__cta">See More Research</a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </article>
</main>


<?php
$args = array(
    'post_type' => 'post',
    'showposts' => 4,
    'status' => 'published'
);
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
    <section class="homeSection homeSection--cards cards">
        <div class="l-container">
            <h2 class="cards__title">News</h2>
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
                                <?php /*if($tags): ?>
                                    <ul class="card__tags">
                                        <?php foreach($tags as $tag): ?>
                                           <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif;*/ ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="cards__ctaWrap">
                <a href="<?php echo get_home_url(); ?>/news" class="cards__cta button button--light">See News Archive</a>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php
get_footer();
