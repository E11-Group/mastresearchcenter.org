<?php
// Filters/actions for the `research` archive.

function taoti_search_research_archive( $query ){

	if ( !is_admin() && $query->is_main_query() && $query->is_post_type_archive( 'research' ) ) {

		if( isset($_GET['research-s']) && $_GET['research-s'] ){
			$query->set('s', sanitize_text_field($_GET['research-s']) );
		}

	}

	return $query;
}
add_action( 'pre_get_posts', 'taoti_search_research_archive', 10 );
