<?php
// use Modules\CTA;

$post_object = get_post_type_object(get_post_type());


get_header();


$search_query = '';
if( isset( $_GET['resource-s']) ){
    $search_query = sanitize_text_field( $_GET['resource-s'] );
}

get_template_part( 'parts/archive--resources' );

get_footer();
