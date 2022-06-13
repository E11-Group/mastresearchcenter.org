<?php
// use Modules\CTA;

$post_object = get_post_type_object(get_post_type());


get_header();



?>
<main class="main">
    <header class="l-container">
        <div class="breadcrumbs">
            <?php echo do_shortcode('[flexy_breadcrumb]'); ?>
        </div>
        <h1 class="main__title pageTitle">Search <?php if(get_search_query()): ?>Results for "<?php echo get_search_query(); ?><?php endif; ?></h1>
    </header>
    
    <div class="searchBar">
        <div class="l-container">
                <form action="/" method="get">
                    <input placeholder="Search..." type="text" name="s" id="searchSearchFacade" value="<?php echo get_search_query(); ?>" />
                    <button type="submit" id="searchSubmit" class="button">Search Resources</a>
                </form>
        </div>
    </div>

    <article class="archiveSection archiveSection--resources">
        <div class="l-container">
            <div class="archive__row flexRow">
                <div class="archive__content">
                    <?php
                    $postCount = $wp_query->post_count;
                    if ( have_posts() ) : ?>
                        <div class="archive__list__results">
                            <div class="archive__list__results__countWrap">
                                <?php if(get_search_query()): ?>
                                    <span class="archive__list__results__for">Results for "<?php echo get_search_query(); ?>"</span>
                                <?php endif; ?>
                                <span class="archive__list__results__count">(<?php echo $postCount; ?> <?php if($postCount == 1){ ?>result<?php } else { ?>results<?php } ?>)</span>
                            </div>
                        </div>
                        <section class="archive__list flexRow">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php
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

                                ?>
                                <div class="card card--blue">
                                    <div class="card__inner">
                                        <?php
                                        $cardImage = false;
                                        if(has_post_thumbnail()){
                                            $cardImage = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
                                            if($cardImage) {
                                                $cardImage = $cardImage[0];
                                            }
                                        }
                                        ?>
                                        <div class="card__image" <?php if($cardImage):?> style="background-image: url(<?php echo $cardImage; ?>)"<?php endif; ?>></div>
                                        <div class="card__contentWrap">
                                            <h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <span class="card__date">Published <?php echo get_the_date('F j, Y'); ?></span>
                                            <div class="card__content"><?php the_excerpt(); ?></div>
                                            <?php if(get_field('file')): ?>
                                                <a target="_blank" class="card__sourceLink" href="<?php the_permalink(); ?>">Download File</a>
                                            <?php endif; ?>
                                           <?php if($sources || $media_types || $emerging_scholars || $evaluation_design || $program_focus || $relationship_type || $populations || $community_type || $date): ?>
                                            <ul class="featuredCard__tags">
                                                <?php foreach($sources as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                                <?php foreach($media_types as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                                <?php foreach($emerging_scholars as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                                <?php foreach($evaluation_design as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                                <?php foreach($program_focus as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                                <?php foreach($populations as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                                <?php foreach($community_type as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                                <?php foreach($date as $tag): ?>
                                                   <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>    
                        
                            <?php endwhile; ?>
                        </section>
                     
                        <?php wp_reset_postdata(); ?>
                     
                    <?php else : ?>

                        <h2>Sorry...</h2>
                        <p>There was no content found based on your search selection. Please adjust your search criteria and try again.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>

</main>


<?php
get_footer();
