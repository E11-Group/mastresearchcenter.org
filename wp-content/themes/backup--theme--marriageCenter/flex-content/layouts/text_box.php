<?php
use Modules\TextBox;

$args = [
    'content' => get_sub_field('content'),
];
$text_box = new TextBox($args);
$text_box->render();