<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<li class="bbp-forum-info">

		<?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) : ?>

			<span class="bbp-row-actions">

				<?php do_action( 'bbp_theme_before_forum_subscription_action' ); ?>

				<?php bbp_forum_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

				<?php do_action( 'bbp_theme_after_forum_subscription_action' ); ?>

			</span>

		<?php endif; ?>
        
        <div class="disputo-forum-table-wrapper">
        <?php 
        if (has_post_thumbnail(bbp_get_forum_id())) {
            $disputo_forum_img_id = get_post_thumbnail_id(bbp_get_forum_id());
            $disputo_forum_img_array = wp_get_attachment_image_src($disputo_forum_img_id, 'thumbnail', true);
            $disputo_forum_img = $disputo_forum_img_array[0];
        ?>      
        <div class="disputo-forum-left">
            <a href="<?php bbp_forum_permalink(); ?>">
                <img src="<?php echo esc_url($disputo_forum_img); ?>" alt="<?php bbp_forum_title(); ?>" />
            </a>
        </div>
        <?php } ?>    
        <div class="disputo-forum-right">
		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>"><?php bbp_forum_title(); ?></a>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

		<?php do_action( 'bbp_theme_before_forum_description' ); ?>

		<div class="bbp-forum-content"><?php bbp_forum_content(); ?></div>

		<?php do_action( 'bbp_theme_after_forum_description' ); ?>

		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

		<?php bbp_list_forums(); ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>
        </div>    
        </div>    

	</li>

	<li class="bbp-forum-topic-count"><?php bbp_forum_topic_count(); ?></li>

	<li class="bbp-forum-reply-count"><?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?></li>
    
    <li class="bbp-forum-freshness">     
        <div class="disputo-freshness-box">
            <div class="disputo-freshness-left">
                <div class="disputo-freshness-name">
                <?php do_action( 'bbp_theme_before_topic_author' ); ?>
                <?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'type' => 'name' ) ); ?>
                <?php do_action( 'bbp_theme_after_topic_author' ); ?>
                </div>
                <div class="disputo-freshness-link">
                <?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
                <?php bbp_forum_freshness_link(); ?>
                <?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>
                </div>
            </div>
            <div class="disputo-freshness-right">
                <?php bbp_author_link( array( 'post_id' => bbp_get_forum_last_active_id(), 'size' => 45, 'type' => 'avatar' ) ); ?>
            </div>
        </div>
	</li>
</ul>