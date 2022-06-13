<?php
// Filters/actions for the `resources` archive.

function taoti_search_resources_archive( $query ){

	if ( !is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'resources' ) ) {

		if( isset($_GET['resource-s']) && $_GET['resource-s'] ){
			$query->set('s', sanitize_text_field($_GET['resource-s']) );
		}

	}

	return $query;
}
add_action( 'pre_get_posts', 'taoti_search_resources_archive', 10 );
