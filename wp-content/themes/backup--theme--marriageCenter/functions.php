<?php


### Function includes
include 'inc/acf/acf.php';
include 'inc/acf/acf-json.php';
include 'inc/wp-reset.php';
include 'inc/post-types.php';
include 'inc/taxonomies.php';
include 'inc/helpers.php';
include 'inc/globals.php';
include 'inc/excerpt.php';
include 'inc/database.php';
include 'inc/walkers.php';
include 'inc/enqueue-critical-css.php';
include 'inc/enqueue.php';
include 'inc/image-sizes.php';
include 'inc/shortcodes.php';
include 'inc/navigation.php';
include 'inc/options.php';
include 'inc/customizer.php';
include 'inc/widgets.php';
include 'inc/admin-bar.php';
include 'inc/tinyMCE/tinymce.styles.php';
include 'inc/tinyMCE/tinymce.toolbars.php';
include 'inc/tinyMCE/tinymce.customizations.php';
include 'inc/user-roles.php';
include 'inc/events.php';
include 'inc/bbpress.php';
include 'inc/bbpress--registration.php';

### Modules
include 'inc/modules.php';

### Page Builder (flex content)
include 'flex-content/flex-content.php';

add_action( 'wp_print_styles', 'deregister_bbpress_styles', 15 );

function deregister_bbpress_styles() {
    wp_deregister_style( 'bbp-default' );
}


function deReg_ur_enqueue_script() {
    wp_deregister_style( 'user-registration-general');
}

add_action( 'wp_print_styles', 'deReg_ur_enqueue_script', 15 );


add_filter( 'mce_buttons_3', 'add_more_buttons' );
function add_more_buttons( $buttons ) {

    $buttons[]='subscript';
    $buttons[]='superscript';
    $buttons[]='cleanup';

return $buttons;

}