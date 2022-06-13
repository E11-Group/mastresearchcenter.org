<?php
use Modules\TwoColumnCards;

$args = [
    'section_title' => get_sub_field('section_title'),
    'section_cta' => get_sub_field('section_cta'),
    'cards' => get_sub_field('cards')
];
$three_column_cards = new TwoColumnCards($args);
$three_column_cards->render();