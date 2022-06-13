<?php
### Add option pages via ACF.

if( function_exists('acf_add_options_page') ) {

	### Examples for adding parent-level option pages.
	// acf_add_options_page('General');
	// acf_add_options_page('Homepage');

	### Example for adding in a child options page.
	// resources
	acf_add_options_page(
		array(
			'page_title' => 'Resource Archive Options',
			'parent_slug' => 'edit.php?post_type=resources'
		)
	);

	acf_add_options_page(
		array(
			'page_title' => 'Research Archive Options',
			'parent_slug' => 'edit.php?post_type=research'
		)
	);

}
