<?php
### Most layouts will retrieve the field values with get_sub_field() and feed those as arguments to one of the modules, then render the module.

use Modules\Accordion;

$args = array(
    'section_title' => get_sub_field('section_title'),
    'accordions' => get_sub_field('accordion_item'),
);
$accordion_object = new Accordion($args);
$accordion_object->render();
