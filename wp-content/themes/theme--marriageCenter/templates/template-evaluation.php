<?php
/*
Template Name: Evaluation Data Toolkit
*/
get_header();

?>

<main class="main">
	<article class="l-container">
		<div class="breadcrumbs">
			<?php echo do_shortcode('[flexy_breadcrumb]'); ?>
		</div>
		<h1 class="main__title pageTitle"><?php the_title(); ?></h1>
		<div class="main__content entryContent"><?php the_content(); ?></div>
	</article>

    <?php $hmre_accordions = get_field('hmre_accordions');
    if( !empty($hmre_accordions) ) : ?>
    <section class="hmre-accordion__container hmre-accordion__above" data-class="accordion">
        <div class="container">
            <?php foreach($hmre_accordions as $hmre_accordion) : ?>
            <div class="hmre-accordion__item" data-class="accordion__item">
                <a href="#" class="hmre-accordion__link" data-class="accordion__link"><?php echo $hmre_accordion['visible_content']; ?><i class="fa-chevron-down fa"></i></a>
                <div class="hmre-accordion__content-hidden entryContent"><?php echo $hmre_accordion['hidden_content']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

	<?php
	$measure = (isset($_GET['eva']) && !empty($_GET['eva'])) ? $_GET['eva'] : '';
	$arr = [
		'evaluation' => 'Evaluation Participant Characteristics',
		'program' => 'Program Participation',
	];
	?>
	<section class="evaluation-data">
		<form method="GET" id="eva-form" action="<?php echo home_url($post->post_name); ?>">
			<div class="evaluation-domain">
				<div class="container">
          <?php if(!empty(get_field('evaluation_domain_main_heading'))): ?>
           <h2 class="evaluation-data__title"><?php the_field('evaluation_domain_main_heading'); ?></h2>
         <?php endif; ?>
         <div class="evaluation-domain__items">
          <div class="evaluation-domain__item evaluation-item">
            <div class="evaluation-card <?php echo (isset($_GET['eva']) && $_GET['eva'] == '1') ? 'active' :'' ?>">
            <?php if(!empty(get_field('evaluation_participant_characteristics_heading'))): ?>
              <h3 class="evaluation-card__title"><?php the_field('evaluation_participant_characteristics_heading'); ?></h3>
            <?php endif; if(!empty(get_field('evaluation_participant_characteristics_description'))): ?>
            <div class="evaluation-card__body">
              <?php the_field('evaluation_participant_characteristics_description'); ?>
            </div>
          <?php endif; ?>
          <div class="evaluation-card__btn-holder">
           <a href="#" class="btn toolkit-data-eva " data-status="eva" data-name="1">Explore</a>
         </div>
       </div>
     </div>
     <div class="evaluation-domain__item evaluation-item">

       <div class="evaluation-card <?php echo (isset($_GET['eva']) && $_GET['eva'] == '2') ? 'active' :'' ?>">
        <?php if(!empty(get_field('program_participation_heading'))): ?>
          <h3 class="evaluation-card__title"><?php the_field('program_participation_heading'); ?></h3>
        <?php endif; if(!empty(get_field('program_participation_description'))): ?>
        <div class="evaluation-card__body">
          <?php the_field('program_participation_description'); ?>
        </div>
      <?php endif; ?>
      <div class="evaluation-card__btn-holder">
       <a href="#" class="btn toolkit-data-eva " data-name="2" data-status="eva">Explore</a>
     </div>
   </div>
 </div>
</div>
</div>
</div>
<div class="ajax-container">
  <?php
  if ($measure !== '') {
    $topic = isset($_GET['tp']) && !empty($_GET['tp']) ? sanitize_text_field($_GET['tp']) : '';
    if ($measure == 1) {
      $measure = 'evaluation';
    }else if($measure == 2){
      $measure = 'program';
    }

    $args = array(
      'taxonomy' => 'measure-topic',
      'hide_empty' => true,
      'parent' => 0,
      'meta_query' => [
       [
        'key' => 'evaluation_domain',
        'value' => $measure,
        'compare' => 'LIKE'
      ]
    ]
  );

    $terms = get_terms($args);
    ?>

    <div class="measure-topic checkbox-block">
      <div class="container">
        <h2 class="checkbox-block__title">Choose a specific topic</h2>
        <div class="checkbox-block__items">
          <?php foreach ($terms as $key => $term): ?>
            <div class="checkbox-block__item">
              <div class="custom-radio">
                <input type="radio" id="<?php echo esc_html($term->slug); ?>" name="tp" value="<?php echo esc_html($term->term_id); ?>"
                class="toolkit-data" <?php checked($term->term_id, $topic); ?> data-status="eva-topic">
                <label for="<?php echo esc_html($term->slug); ?>">
                  <?php echo esc_html($term->name); ?>
                </label>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>

    <?php
    if ($topic !== '') {
      $subtopic = isset($_GET['stp']) && !empty($_GET['stp']) ? sanitize_text_field($_GET['stp']) : '';
      $args = array(
       'taxonomy' => 'measure-topic',
       'hide_empty' => true,
       'parent' => $topic,
     );

      $subtopics = get_terms($args);
      ?>

      <div class="measure-subtopic checkbox-block">
        <div class="container">
          <h2 class="measure-subtopic__title">Choose a Subtopic</h2>


          <div class="checkbox-block__items">

            <?php foreach ($subtopics as $key => $stopic): ?>
              <div class="checkbox-block__item">
                <div class="custom-radio">
                  <input type="radio" id="<?php echo esc_html($stopic->slug); ?>" name="stp" value="<?php echo esc_html($stopic->term_id); ?>"
                  class="toolkit-data" <?php checked($stopic->term_id, $subtopic) ?>  data-status="eva-subtopic">
                  <label for="<?php echo esc_html($stopic->slug); ?>">
                    <?php echo esc_html($stopic->name); ?>
                  </label>
                </div>
              </div>
            <?php endforeach ?>

          </div>
        </div>
      </div>

      <?php
      if ($subtopic !== '') {
        $args = array(
          'post_type' => 'measure',
          'tax_query' => array(
           array(
            'taxonomy' => 'measure-topic',
            'field' => 'id',
            'terms' => $subtopic
          )
         ),
          'meta_key' => 'measure_domain',
          'meta_value' => $measure,
          'meta_compare' => '=',
        );
        ?>

        <?php
        $cat_topic = get_term_by('term_id', $_GET['tp'], 'measure-topic');
        $cat_subtopic = get_term_by('term_id', $_GET['stp'], 'measure-topic');
        ?>

        <div class="measure-data">
          <div class="container">
           <h2 class="measure-data__title">Data...</h2>
           <ul class="measure-data__breadcrumb">
            <li><?php echo esc_html($arr[$measure] ); ?> <span> > </span></li>
            <li><?php echo esc_html($cat_topic->name); ?> <span> > </span></li>
            <li><?php echo esc_html($cat_subtopic->name); ?></li>
          </ul>

          <?php
          $the_query = new WP_Query($args);
          if ($the_query->have_posts()) :
            ?>

            <div class="measure-data__wrap">
              <div class="measure-table">
                <div class="measure-table__header">
                  <div class="measure-table__tr">Measure</div>
                  <?php if ($measure == 'evaluation'){ ?>
                    <div class="measure-table__tr">
                      <h3 class="measure-table__head-title">BSF</h3>
                      <div class="measure-table__head-items">
                        <span class="measure-table__head-item">Baseline</span>
                        <span class="measure-table__head-item">15-Month Follow-Up</span>
                        <span class="measure-table__head-item">36-Month Follow-Up</span>
                      </div>
                    </div>
                    <div class="measure-table__tr">
                      <h3 class="measure-table__head-title">SHM</h3>
                      <div class="measure-table__head-items">
                        <span class="measure-table__head-item">Baseline</span>
                        <span class="measure-table__head-item">Child Longitudinal Data: Baseline</span>
                        <span class="measure-table__head-item">12-Month Follow-Up</span>
                        <span class="measure-table__head-item">Child Longitudinal Data: 12-Month</span>
                        <span class="measure-table__head-item">30-Month Follow-Up</span>
                        <span class="measure-table__head-item">Child Longitudinal Data: 30-Month</span>
                        <span class="measure-table__head-item">30-M Youth Survey</span>
                      </div>
                    </div>
                  <?php } ?>
                  <?php if ($measure == 'program'): ?>
                    <div class="measure-table__tr">
                      <h3 class="measure-table__head-title">BSF</h3>
                      <div class="measure-table__head-items">
                        <span class="measure-table__head-item">Management Information System (MIS)</span>
                      </div>
                    </div>
                    <div class="measure-table__tr">
                      <h3 class="measure-table__head-title">SHM</h3>
                      <div class="measure-table__head-items">
                        <span class="measure-table__head-item">Baseline</span>
                        <span class="measure-table__head-item">12-Month Follow-Up</span>
                        <span class="measure-table__head-item">MIS Extended Activities</span>
                        <span class="measure-table__head-item">MIS Family Support</span>
                        <span class="measure-table__head-item">MIS Marriage Education</span>
                        <span class="measure-table__head-item">MIS Payments</span>
                        <span class="measure-table__head-item">MIS Referrals</span>
                      </div>
                    </div>
                  <?php endif ?>
                </div>
                <div class="measure-table__body">
                 <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <?php $measure_name = get_field('measure_name'); ?>
                  <?php
                  if ($measure == 'evaluation'){
                    $eva_bsf = get_field('measure_evaluation_bsf');
                    $eva_shm = get_field('measure_evaluation_shm');
                    ?>
                    <div class="measure-table__tr evaluation">
                      <div class="measure-table__data-items">
                        <span class="measure-table__data-value"><?php echo esc_html($measure_name); ?></span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('baseline', $eva_bsf)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('fifteen-month', $eva_bsf)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('thirty-six-month', $eva_bsf)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('baseline', $eva_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('child-baseline', $eva_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('twelve-month', $eva_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('child-twelve-month', $eva_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('thirty-month', $eva_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('child-thirty-month', $eva_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('youth-survey', $eva_shm)){ echo 'X'; } ?>
                        </span>
                      </div>
                    </div>
                    <?php
                  }
                  if($measure == 'program' ){
                    $program_bsf = get_field('measure_program_bsf');
                    $program_shm = get_field('measure_program_shm');
                    ?>
                    <div class="measure-table__tr program">
                      <div class="measure-table__data-items">
                        <span class="measure-table__data-value"><?php echo esc_html($measure_name);  ?></span>
                        <span class="measure-table__data-value full">
                          <?php if(in_array('management', $program_bsf)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('baseline', $program_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('twelve-month', $program_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('activities', $program_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('support', $program_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('education', $program_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('payments', $program_shm)){ echo 'X'; } ?>
                        </span>
                        <span class="measure-table__data-value">
                          <?php if(in_array('referrals', $program_shm)){ echo 'X'; } ?>
                        </span>
                      </div>
                    </div>
                  <?php } ?>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        <?php endif;
        wp_reset_postdata();
        ?>
      </div>
    </div>

  <?php } ?>
<?php } ?>
<?php } ?>
</div>
<div class='loading' style="display: none;"><img src="<?php echo get_template_directory_uri(); ?>/images/loader-image.gif" alt=""></div>
</form>
</section>

    <?php $hmre_general_content_below_the_toolkit = get_field('hmre_general_content_below_the_toolkit');
            if(!empty($hmre_general_content_below_the_toolkit)) : ?>
    <div class="hmre_genContent">
        <div class="entryContent"><?php echo $hmre_general_content_below_the_toolkit; ?></div>
    </div>
    <?php endif; ?>

<?php $subtopic = isset($_GET['stp']) && !empty($_GET['stp']) ? sanitize_text_field($_GET['stp']) : ''; ?>
<section class="save-data" <?php echo ($subtopic !== '') ? '' : 'style="display:none;"'; ?>>
  <div class="container">
   <header class="save-data__header">
    <h2 class="save-data__title">Save Your Data</h2>
    <p>Email a link to this page to yourself so you can revisit it at any point in the future.</p>
  </header>
  <form method="POST" id="eva-saveform" class="save-data__form" action="<?php echo home_url($post->post_name); ?>">
    <input class="save-data__email" type="email" name="email" placeholder="Email Address" value="" id="eva-email">
    <input class="save-data__link" type="hidden" name="url" value="" id="eva-link">
    <input class="save-data__submit" type="submit" name="Submit">
  </form>
</div>
</section>

    <?php $hmre_general_content_bel_the_toolkit = get_field('hmre_general_content_bel_the_toolkit');
            if(!empty($hmre_general_content_bel_the_toolkit)) : ?>
    <div class="hmre_genContent2">
        <div class="container">
            <div class="entryContent"><?php echo $hmre_general_content_bel_the_toolkit; ?></div>
        </div>
    </div>
    <?php endif; ?>

    <?php $hmre_accordions_below = get_field('hmre_accordions_below');
    if( !empty($hmre_accordions_below) ) : ?>
    <section class="hmre-accordion__container" data-class="accordion">
        <div class="container">
            <?php foreach($hmre_accordions_below as $hmre_accordion) : ?>
            <div class="hmre-accordion__item" data-class="accordion__item">
                <a href="#" class="hmre-accordion__link" data-class="accordion__link"><?php echo $hmre_accordion['visible_content']; ?><i class="fa-chevron-down fa"></i></a>
                <div class="hmre-accordion__content-hidden entryContent"><?php echo $hmre_accordion['hidden_content']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
<?php the_page_builder(); ?>
</main>

<?php get_footer();
