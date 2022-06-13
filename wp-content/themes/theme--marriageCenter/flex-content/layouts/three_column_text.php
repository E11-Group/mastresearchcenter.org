<?php
use Modules\ThreeColumnText;

$args = [
    'column1' => get_sub_field('column_1'),
    'column2' => get_sub_field('column_2'),
    'column3' => get_sub_field('column_3')
];
$three_column_text = new ThreeColumnText($args);
$three_column_text->render();