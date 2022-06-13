<?php
use Modules\TwoColumnText;

$args = [
    'column1' => get_sub_field('column_1'),
    'column2' => get_sub_field('column_2')
];
$two_column_text = new TwoColumnText($args);
$two_column_text->render();