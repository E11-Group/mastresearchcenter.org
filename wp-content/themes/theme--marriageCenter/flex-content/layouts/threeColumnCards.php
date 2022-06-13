<?php
use Modules\ThreeColumnCards;

$args = [
    'section_title' => get_sub_field('section_title'),
    'section_cta' => get_sub_field('section_cta'),
    'cards' => get_sub_field('cards'),
];
$three_column_cards = new ThreeColumnCards($args);
$three_column_cards->render();