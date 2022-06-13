<?php

/**
 * my_terms_clauses
 *
 * filter the terms clauses
 *
 * @param $clauses array
 * @param $taxonomy string
 * @param $args array
 * @return array
 * @link http://wordpress.stackexchange.com/a/183200/45728
 **/
function e11_terms_clauses( $clauses, $taxonomy, $args ) {
  global $wpdb;

  if ( array_key_exists('post_types', $args) ) {
    $post_types = $args['post_types'];

    // allow for arrays
    if ( is_array($args['post_types']) ) {
      $post_types = implode("','", $args['post_types']);
    }
    $clauses['join'] .= " INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id";
    $clauses['where'] .= " AND p.post_type IN ('". esc_sql( $post_types ). "') GROUP BY t.term_id";
  }
  return $clauses;
}
add_filter('terms_clauses', 'e11_terms_clauses', 99999, 3);