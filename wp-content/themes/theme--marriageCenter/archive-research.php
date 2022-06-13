<?php
 use Modules\Accordion;

$post_object = get_post_type_object(get_post_type());


get_header();


$search_query = '';
if( isset( $_GET['resource-s']) ){
    $search_query = sanitize_text_field( $_GET['resource-s'] );
}

get_template_part( 'parts/archive--research' );



$args = array(
    'section_title' => get_field('research_section_title', 'option'),
    'accordions' => get_field('research_accordion_item', 'option'),
);
$accordion_object = new Accordion($args);
$accordion_object->render();


get_footer();
