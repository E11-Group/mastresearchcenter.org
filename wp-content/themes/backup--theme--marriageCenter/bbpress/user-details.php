<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<?php do_action( 'bbp_template_before_user_details' ); ?>
<?php
$disputo_bbpress_user_avatar = get_theme_mod('disputo_bbpress_user_avatar');
$custom_avatar = get_user_meta(bbp_get_displayed_user_field( 'ID' ), 'disputo_cmb2_user_avatar' );
$custom_avatar_img = wp_get_attachment_image_src( get_user_meta( bbp_get_displayed_user_field( 'ID' ), 'disputo_cmb2_user_avatar_id', 1 ), 'thumbnail' );
?>
	<div id="bbp-single-user-details">
        <?php if ($disputo_bbpress_user_avatar && $custom_avatar) { ?>
		<div id="bbp-user-avatar">
            <a href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>">
                <img src="<?php echo esc_url($custom_avatar_img[0]); ?>" alt="<?php bbp_displayed_user_field( 'display_name' ); ?>" />
            </a>
		</div>
        <?php } else { ?>
        <div id="bbp-user-avatar">
            <a href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>">
                <?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
            </a>
		</div>
        <?php } ?>
        <?php 
        $usernav = '';
        if ( !bbp_is_user_home() ) { 
            $usernav = 'bbp-user-navigation-hide';
        }
        ?>
		<div id="bbp-user-navigation" class="<?php echo esc_attr($usernav); ?>">
			<ul class="list-group">
				<li class="list-group-item bg-primary">
					<span class="bbp-user-profile-link">
						<a class="text-white" href="<?php bbp_user_profile_url(); ?>"><?php esc_html_e( 'Profile', 'disputo' ); ?></a>
					</span>
				</li>
				<li class="list-group-item <?php if ( bbp_is_single_user_topics() ) : ?>active<?php endif; ?>">
					<span class='bbp-user-topics-created-link'>
						<a href="<?php bbp_user_topics_created_url(); ?>"><?php esc_html_e( 'Topics Started', 'disputo' ); ?></a>
					</span>
				</li>
				<li class="list-group-item <?php if ( bbp_is_single_user_replies() ) : ?>active<?php endif; ?>">
					<span class='bbp-user-replies-created-link'>
						<a href="<?php bbp_user_replies_created_url(); ?>"><?php esc_html_e( 'Replies Created', 'disputo' ); ?></a>
					</span>
				</li>
				<?php if ( bbp_is_favorites_active() ) : ?>
					<li class="list-group-item <?php if ( bbp_is_favorites() ) : ?>active<?php endif; ?>">
						<span class="bbp-user-favorites-link">
							<a href="<?php bbp_favorites_permalink(); ?>"><?php esc_html_e( 'Favorites', 'disputo' ); ?></a>
						</span>
					</li>
				<?php endif; ?>
				<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>
					<?php if ( bbp_is_subscriptions_active() ) : ?>
						<li class="list-group-item <?php if ( bbp_is_subscriptions() ) : ?>active<?php endif; ?>">
							<span class="bbp-user-subscriptions-link">
								<a href="<?php bbp_subscriptions_permalink(); ?>"><?php esc_html_e( 'Subscriptions', 'disputo' ); ?></a>
							</span>
						</li>
					<?php endif; ?>
					<li class="list-group-item <?php if ( bbp_is_single_user_edit() ) :?>active<?php endif; ?>">
						<span class="bbp-user-edit-link">
							<a href="<?php bbp_user_profile_edit_url(); ?>"><?php esc_html_e( 'Edit Profile', 'disputo' ); ?></a>
						</span>
					</li>
				<?php endif; ?>    
                <?php if ( bbp_is_user_home() ) : ?>
                <li class="list-group-item">
                    <span class="bbp-user-edit-link">
                    <a href="<?php echo wp_logout_url( home_url() ); ?>"><?php esc_html_e( 'Logout', 'disputo' ); ?></a>
                    </span>
				</li>
                <?php endif; ?>    
			</ul>
		</div>
	</div>
	<?php do_action( 'bbp_template_after_user_details' ); ?>