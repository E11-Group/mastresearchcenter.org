<main class="main">
    <?php if(is_post_type_archive() && get_post_type() == 'research'): ?>
        <header class="l-container">
            <div class="breadcrumbs">
                            <!-- Flexy Breadcrumb -->
                <div class="fbc fbc-page">

                    <!-- Breadcrumb wrapper -->
                    <div class="fbc-wrap">

                        <!-- Ordered list-->
                        <ol class="fbc-items" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <span itemprop="name">
                        <!-- Home Link -->
                        <a itemprop="item" href="<?php echo get_home_url(); ?>">
                            Home                    </a>
                    </span>
                    <meta itemprop="position" content="1"><!-- Meta Position-->
                </li>
                <span>▶</span><li class="active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo get_home_url(); ?>/about-the-mast-center" title="Research"><span itemprop="name" title="Research">MAST Center Research</span></a><meta itemprop="position" content="2"></li>                    </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <h1 class="main__title pageTitle"><?php echo get_field('research_title', 'option'); ?></h1>
            <div class="pageDescription main__content entryContent"><?php echo get_field('research_intro_text', 'option'); ?></div>
        </header>
    <?php endif; ?>

    <div class="resourcesSearch searchBar">
        <div class="l-container">
                <form>
                    <input placeholder="Search..." type="text" id="searchSearchFacade" value="<?php echo $search_query; ?>" />
                    <a href="#" id="resourcesSearchSubmit" class="button">Search Research</a>
                </form>
        </div>
    </div>

    <article class="archiveSection archiveSection--resources">
        <div class="l-container">
            <div class="archive__row flexRow">
                <aside class="archive__sidebar">
                    
                    <form id="resourcesFilterForm" class="archive__filters" action="/mast-center-research/" method="get">
                        <?php
                        $types = get_terms('research-types', array('hide_empty' => false, 'parent' => 0));
                        $topics = get_terms('topics', array('hide_empty' => false, 'parent' => 0));
                        $date = get_terms('research-date', array('hide_empty' => false, 'parent' => 0));

                        $sanitized_types = array();
                        if( isset($_GET['types']) && is_array($_GET['types']) ){
                            foreach( $_GET['types'] as $key => $value ){
                                $sanitized_types[ sanitize_text_field($key) ] = sanitize_text_field($value);
                            }
                        }

                        $sanitized_topics = array();
                        if( isset($_GET['topics']) && is_array($_GET['topics']) ){
                            foreach( $_GET['topics'] as $key => $value ){
                                $sanitized_topics[ sanitize_text_field($key) ] = sanitize_text_field($value);
                            }
                        }


                        $sanitized_date = array();
                        if( isset($_GET['date']) && is_array($_GET['date']) ){
                            foreach( $_GET['date'] as $key => $value ){
                                $sanitized_date[ sanitize_text_field($key) ] = sanitize_text_field($value);
                            }
                        }

                        ?>

                        <div class="archive__filter">
                            <h3 class="archive__filter__title">Research Type <span>+</span></h3>
                            <div class="archive__filter__itemGroupWrap">
                                <?php foreach($types as $item): ?>
                                    <div class="archive__filter__itemGroup">
                                        <input <?php if( in_array( $item->slug, $sanitized_media ) ){ ?>checked<?php } ?> class="archive__filter__checkbox" id="<?php echo $item->slug; ?>" name="media-types[]" value="<?php echo $item->slug; ?>" type="checkbox">
                                        <label class="archive__filter__label" for="<?php echo $item->slug; ?>"><?php echo $item->name; ?></label>
                                        <?php
                                        $itemChildrenArgs = array(
                                           'hierarchical' => 1,
                                           'show_option_none' => '',
                                           'hide_empty' => 0,
                                           'parent' => $item->term_id,
                                           'taxonomy' => $item->taxonomy
                                        );
                                        $itemChildren = get_terms($itemChildrenArgs);

                                        foreach($itemChildren as $child): ?>
                                            <input <?php if( in_array( $child->slug, $sanitized_types ) ){ ?>checked<?php } ?> class="archive__filter__checkbox" id="<?php echo $child->slug; ?>" name="media-types[]" value="<?php echo $child->slug; ?>" type="checkbox">
                                            <label class="archive__filter__label archive__filter__label--child" for="<?php echo $child->slug; ?>"><?php echo $child->name; ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="archive__filter">
                            <h3 class="archive__filter__title">Date <span>+</span></h3>
                            <div class="archive__filter__itemGroupWrap">
                                <?php foreach($date as $item): ?>
                                    <div class="archive__filter__itemGroup">
                                        <input <?php if( in_array( $item->slug, $sanitized_date ) ){ ?>checked<?php } ?> class="archive__filter__checkbox" id="<?php echo $item->slug; ?>" name="date[]" value="<?php echo $item->slug; ?>" type="checkbox">
                                        <label class="archive__filter__label" for="<?php echo $item->slug; ?>"><?php echo $item->name; ?></label>
                                        <?php
                                        $itemChildrenArgs = array(
                                           'hierarchical' => 1,
                                           'show_option_none' => '',
                                           'hide_empty' => 0,
                                           'parent' => $item->term_id,
                                           'taxonomy' => $item->taxonomy
                                        );
                                        $itemChildren = get_terms($itemChildrenArgs);

                                        foreach($itemChildren as $child): ?>
                                            <input <?php if( in_array( $child->slug, $sanitized_date ) ){ ?>checked<?php } ?> class="archive__filter__checkbox" id="<?php echo $child->slug; ?>" name="date[]" value="<?php echo $child->slug; ?>" type="checkbox">
                                            <label class="archive__filter__label archive__filter__label--child" for="<?php echo $child->slug; ?>"><?php echo $child->name; ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <input id="resourceSearchOrder" type="hidden" name="order" value="ASC">
                        <input id="resourceSearchOrderBy" type="hidden" name="orderby" value="">
                        <input type="hidden" name="post_type" value="research">

                       
                        <input type="hidden" name="resource-s" value="<?php echo $search_query; ?>">
                        
                        <div class="archive__filter__buttonWrap">
                            <button type="submit" class="archive__filter__submit">Apply Filters</button>
                            <input class="button button--light" type="reset" value="Reset">
                        </div>
                    </form>
                </aside>
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
                            <div class="archive__list__results__sort">
                                <span>Sort By:</span>
                                <select name="#" id="archive__list__results__sort__select">
                                    <option <?php if( !isset($_GET['orderby']) && isset($_GET['order']) && $_GET['order'] == 'DESC'){ echo 'selected'; } ?> id="resourceOrderDesc" value="DESC">Newest to Oldest</option>
                                    <option <?php if( !isset($_GET['orderby']) || $_GET['orderby'] != 'title' && isset($_GET['order']) && $_GET['order'] == 'ASC'){ echo 'selected'; } ?> id="resourceOrderAsc" value="ASC">Oldest to Newest</option>
                                    <option <?php if( isset($_GET['order']) && $_GET['order'] == 'ASC' && isset($_GET['orderby']) && $_GET['orderby'] == 'title'){ echo 'selected'; } ?> id="resourceOrderAZ" value="title-z-to-a">Alphabetically A - Z</option>
                                    <option <?php if( isset($_GET['order']) && $_GET['order'] == 'DESC' && isset($_GET['orderby']) && $_GET['orderby'] == 'title'){ echo 'selected'; } ?> id="resourceOrderZA" value="title-a-to-z">Alphabetically Z - A</option>
                                </select>
                            </div>
                        </div>
                        <section class="archive__list flexRow">
                            <?php
                                global $wp_query;
                                $args = array_merge( $wp_query->query_vars, ['posts_per_page' => 9 ] );
                                query_posts( $args );
                            ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php
                                $tagArgs = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                                $types = wp_get_post_terms( get_the_id(), 'types', $tagArgs );
                                $topics = wp_get_post_terms( get_the_id(), 'topics', $tagArgs );
                                $media_types = wp_get_post_terms( get_the_id(), 'media-types', $tagArgs );;
                                ?>
                                <div class="card card--blue">
                                    <div class="card__inner">
                                        <?php
                                        if(has_post_thumbnail(get_the_ID())){
                                            $cardImage = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
                                            if($cardImage) {
                                                $cardImage = $cardImage[0];
                                            }
                                        } else {
                                            $cardImage = false;
                                        }
                                        ?>
                                        <div class="card__image" <?php if($cardImage):?> style="background-image: url(<?php echo $cardImage; ?>)"<?php endif; ?>></div>
                                        <div class="card__contentWrap">
                                            <h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <span class="card__date">Published <?php echo get_the_date('F j, Y'); ?></span>
                                            <div class="card__content"><?php the_excerpt(); ?></div>
                                            <?php if(get_field('file')): ?>
                                                <a style="display: none;" target="_blank" class="card__sourceLink" href="<?php the_permalink(); ?>">Download File</a>
                                            <?php endif; ?>
                                            <?php if($types || $topics || $media_types): ?>
                                                <ul style="display: none" class="card__tags">
                                                    <?php foreach($types as $tag): ?>
                                                       <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                    <?php endforeach; ?>
                                                    <?php foreach($topics as $tag): ?>
                                                       <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                    <?php endforeach; ?>
                                                    <?php foreach($media_types as $tag): ?>
                                                       <li><a href="<?php echo get_home_url(); ?>/<?php echo $tag->taxonomy; ?>/<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>    
                        
                            <?php endwhile; ?>
                        </section>
                        
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="pagination-arrow pagination-arrow-left"></i>',
                            'next_text' => '<i class="pagination-arrow pagination-arrow-right"></i>',
                            'screen_reader_text' => null
                        ) );
                        ?>
                        <?php wp_reset_postdata(); ?>
                     
                    <?php else : ?>

                        <h2>Sorry...</h2>
                        <p>There were no research documents found based on your filter selection. Please adjust your search criteria and try again.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>

</main>