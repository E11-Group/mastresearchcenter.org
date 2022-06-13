<?php
### Useful functions for this particular theme.
// Set up any `add_action`s or `add_filter`s here.

add_filter('wp_mail_from','yoursite_wp_mail_from');
function yoursite_wp_mail_from($content_type) {
  return 'noreply@mastresearchcenter.org';
}
add_filter('wp_mail_from_name','yoursite_wp_mail_from_name');
function yoursite_wp_mail_from_name($name) {
  return 'MAST Center';
}

//Save Form Ajax
add_action('wp_ajax_measure', 'mrs_measure_data_save');
add_action('wp_ajax_nopriv_measure','mrs_measure_data_save');

function mrs_measure_data_save(){
	$page_link = '';
	if (isset($_POST['page_link']) && !empty($_POST['page_link'])) {
		$page_link = $_POST['page_link'];
	}
	if (isset($_POST['email']) && !empty($_POST['email'])) {

		$to = $_POST['email'];
		$subject = 'Evaluation Data Save';
		$body = 'Save Data Page Link: ' . $page_link;
		$headers = array('Content-Type: text/html; charset=UTF-8');

		wp_mail( $to, $subject, $body, $headers );

	}

	wp_die();
}

//AJAX Function
add_action('wp_ajax_measure_domain', 'mrs_measure_topic');
add_action('wp_ajax_nopriv_measure_domain','mrs_measure_topic');

function mrs_measure_topic(){
	$status = $_POST['status'];

	if (isset($_POST['data_value']) && !empty($_POST['data_value'])) {
		$data_value = sanitize_text_field($_POST['data_value']);

    if ($data_value == 1) {
      $data_value = 'evaluation';
    }
    else if ($data_value == 2){
      $data_value = 'program';
    }

    $args = array(
     'taxonomy'		=> 'measure-topic',
     'hide_empty'	=> true,
   );

    if (isset($status) && !empty($status)) {
     if ($status === 'eva') {
      $args['parent'] = 0;
      $args['meta_query'] = [[
       'key'       => 'evaluation_domain',
       'value'		=> $data_value,
       'compare'	=> 'LIKE'
     ]];
   }
   else if($status === 'eva-topic'){
    $args['parent'] = $data_value;
  }
  if ($status == 'eva' || $status == 'eva-topic') {
    $terms = get_terms( $args );
    if (empty($terms)) {
      echo "Not Found";
    }
    ?>
    <div class="checkbox-block__items">
     <?php foreach ($terms as $term): ?>
      <div class="checkbox-block__item">
       <div class="custom-radio">
        <input type="radio" id="<?php echo esc_attr($term->slug); ?>" name="<?php echo esc_attr($status == 'eva') ? 'topic' : 'sub-topic'; ?>" value="<?php echo absint($term->term_id); ?>" class="toolkit-data" data-status="<?php echo esc_attr($status == 'eva') ? 'eva-topic' : 'eva-subtopic'; ?>" >
        <label for="<?php echo esc_attr($term->slug); ?>">
         <?php echo esc_html($term->name); ?>
       </label>
     </div>
   </div>
 <?php endforeach ?>
</div>
<?php
}
else if($status == 'eva-subtopic'){
  $eva = sanitize_text_field($_POST['eva'] ? $_POST['eva'] : '');
  if ($eva == 1) {
    $eva = 'evaluation';
  } else if ($eva == 2){
    $eva = 'program';
  }
  $args = array(
   'post_type'		=> 'measure',
    'orderby' => 'publish_date',
    'order' => 'ASC',
   'tax_query'		=> array(
    array(
     'taxonomy'	=> 'measure-topic',
     'field'		=> 'id',
     'terms'		=> $data_value
   )
  ),
   'meta_key' => 'measure_domain',
   'meta_value' => $eva,
   'meta_compare' => '=',
 );

  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) :
   $topic_term = '';
   if (isset($_POST['eva_topic']) && !empty($_POST['eva_topic'])) {
    $topic_term = get_term_by('term_id', $_POST['eva_topic'], 'measure-topic');
  }
  $subtopic_term = get_term_by('term_id', $data_value, 'measure-topic');
  ?>
  <ul class="measure-data__breadcrumb">
    <?php
    if ($eva != ''){
     $eva_title = '';
     if ($eva == 'evaluation') {
      $eva_title = "Evaluation Participant Characteristics";
    }else if($eva == 'program' ){
      $eva_title = "Program Participation and Implementation";
    }
    ?>
    <li><?php echo esc_html($eva_title); ?> <span> > </span></li>
  <?php } ?>
  <?php if ($topic_term != ''){ ?>
   <li><?php echo esc_html($topic_term->name); ?> <span> > </span></li>
 <?php } ?>
 <?php if ($subtopic_term){ ?>
   <li><?php echo esc_html($subtopic_term->name); ?></li>
 <?php } ?>
</ul>

<div class="measure-data__wrap">
  <div class="measure-table">
   <div class="measure-table__header">
    <div class="measure-table__tr">

    </div>
    <?php if ($eva == 'evaluation'){ ?>
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
<?php if ($eva == 'program'): ?>
 <div class="measure-table__tr">
  <h3 class="measure-table__head-title">BSF</h3>
  <div class="measure-table__head-items">
   <span class="measure-table__head-item full">Management Information System (MIS)</span>
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
    if ($eva == 'evaluation'){
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
 if($eva == 'program' ){
  $program_bsf = get_field('measure_program_bsf');
  $program_shm = get_field('measure_program_shm');
  ?>
  <div class="measure-table__tr program">
   <div class="measure-table__data-items">
    <span class="measure-table__data-value"><?php echo esc_html($measure_name); ?></span>
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
<?php
endif; wp_reset_postdata();

}
}
}

wp_die();
}


//Add Admin page for CSV Importer
function mrs_admin_menu() {
	add_menu_page(
		__( 'CSV Importer', 'mrs' ),
		__( 'Measure CSV Importer', 'mrs' ),
		'manage_options',
		'measure-importer',
		'mrs_page_contents',
		'dashicons-database-import'
	);
}

add_action( 'admin_menu', 'mrs_admin_menu' );

function mrs_page_contents() {
	?>
	<h1><?php esc_html_e( 'Measure CSV Importer', 'my-plugin-textdomain' ); ?></h1>
	<form method='post' action='<?php echo menu_page_url( 'measure-importer', false); ?>' enctype='multipart/form-data'>

		<div class="importer-form">
			<p>
				<input type="radio" name="eva_domain" id="evaluation" value="evaluation" required="required">
				<label for="evaluation">Evaluation Participant Characteristics</label>
				<br>
				<input type="radio" name="eva_domain" id="program" value="program" required="required">
				<label for="program">Program Participation and Implementation</label>
			</p>
			<p>
				<label for="csv_file">Choose a csv file:</label>
				<input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="csv_file" required="required"/>
			</p>
			<p>
				<input type="submit" name="csv-submit" value="Submit">
			</p>


		</div>

	</form>
	<?php

	$success = false;
	if(isset($_POST['csv-submit'])){

		$extension = pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION);

		if(!empty($_FILES['csv_file']['name']) && $extension == 'csv' && !empty($_POST['eva_domain'])){

			$csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');

			fgetcsv($csvFile);

			$data = array();
			while(($csvData = fgetcsv($csvFile)) !== FALSE){

				$csvData 	= array_map("utf8_encode", $csvData);

				$evaluation_domain = $_POST['eva_domain'];
				$topic 				     = trim($csvData[0]);
				$subtopic 			   = trim($csvData[1]);
				$title 				     = trim($csvData[2]);
        $measure_name      = trim($csvData[2]);
        $evaluation_bsf 	 = [];
        $evaluation_shm 	 = [];
        $program_bsf 		   = [];
        $program_shm 		   = [];

        if ($evaluation_domain == 'evaluation') {

         $evaluation_bsf['baseline'] = trim($csvData[3] ? 'baseline': '');
         $evaluation_bsf['fifteen-month'] = trim($csvData[4] ? 'fifteen-month': '');
         $evaluation_bsf['thirty-six-month'] = trim($csvData[5] ? 'thirty-six-month': '');
         $evaluation_shm['baseline'] = trim($csvData[6] ? 'baseline': '');
         $evaluation_shm['child-baseline'] = trim($csvData[7] ? 'child-baseline': '');
         $evaluation_shm['twelve-month'] = trim($csvData[8] ? 'twelve-month': '');
         $evaluation_shm['child-twelve-month'] = trim($csvData[9] ? 'child-twelve-month': '');
         $evaluation_shm['thirty-month'] = trim($csvData[10] ? 'thirty-month': '');
         $evaluation_shm['child-thirty-month'] = trim($csvData[11] ? 'child-thirty-month': '');
         $evaluation_shm['youth-survey'] = trim($csvData[12] ? 'youth-survey': '');
         array_push($data, array($evaluation_domain, $topic, $subtopic, $title, $measure_name, $evaluation_bsf, $evaluation_shm));

       }else{
         $program_bsf['management'] = trim($csvData[3] ? 'management' : '');
         $program_shm['baseline'] = trim($csvData[4] ? 'baseline' : '');
         $program_shm['twelve-month'] = trim($csvData[5] ? 'twelve-month' : '');
         $program_shm['activities'] = trim($csvData[6] ? 'activities' : '');
         $program_shm['support'] = trim($csvData[7] ? 'support' : '');
         $program_shm['education'] = trim($csvData[8] ? 'education' : '');
         $program_shm['payments'] = trim($csvData[9] ? 'payments' : '');
         $program_shm['referrals'] = trim($csvData[10] ? 'referrals' : '');
         array_push($data, array($evaluation_domain, $topic, $subtopic, $title, $measure_name, $program_bsf, $program_shm));
       }

     }
     fclose($csvFile);

     if (is_array($data)) {
     $dateCounter = 1;
      foreach ($data as $key => $value) {
       if (!empty($value[1])) {
        $dateCounter++;
						//Add Post
        $post_id = wp_insert_post(array(
         'post_title'	=> $value[3],
         'post_type'		=> 'measure',
         'post_status'	=> 'publish',
         'menu_order'	=> $dateCounter
       ));

        if (!empty($post_id) || !empty($value[0])) {
         update_field('measure_domain',$value[0],$post_id);
         if (!empty($value[3])) {
          update_field('measure_name',$value[3],$post_id);
        }

        if ($value[0] == 'evaluation') {
          update_field('measure_evaluation_bsf',$value[5],$post_id);
          update_field('measure_evaluation_shm',$value[6],$post_id);
        }
        else{
          update_field('measure_program_bsf',$value[5],$post_id);
          update_field('measure_program_shm',$value[6],$post_id);
        }

				//Add Term
        $parent_id = term_exists( $value[1], 'measure-topic' );
        if($parent_id == 0 || $parent_id == null ){
          $parent_term = wp_insert_term(
           $value[1],
           'measure-topic'
         );
          $parent_id = (!is_wp_error($parent_term)) ? $parent_term : false;
          update_term_meta($parent_id['term_id'],'evaluation_domain',$value[0]);
        }

        if($parent_id && !empty($value[2])){
          $child_id = term_exists( $value[2], 'measure-topic', $parent_id['term_id'] );
          if($child_id == 0 || $child_id == null ){
           $child_term = wp_insert_term(
            $value[2],
            'measure-topic',
            array(
             'description' => '',
             'slug'        => '',
             'parent'      => $parent_id['term_id']
           )
          );
           update_term_meta($parent_id['term_id'],'evaluation_domain',$value[0]);
         }

         $child_id = (!empty($child_term) && !is_wp_error($child_term)) ? $child_term : $child_id;
         if($child_id){

          $id=[];
          array_push($id,$parent_id['term_id'],$child_id['term_id']);

          wp_set_post_terms($post_id,$id, 'measure-topic');
          $success = true;
        }
      }
    }
  }

}
}
?>
<?php if ($success === true){ ?>
  <div class="csv-covert-success">
   <p>
    Succefully Import Data.
  </p>
</div>
<?php }
}
}
}

// Add the custom columns to the book post type:
add_filter( 'manage_measure_posts_columns', 'e11_set_measure_columns' );
function e11_set_measure_columns($columns) {
  $columns['topic'] = 'Topic';
  $columns['subtopic'] = 'SubTopic';

  return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_measure_posts_custom_column' , 'e11_measure_column', 10, 2 );
function e11_measure_column( $column, $post_id ) {
  switch ( $column ) {

    case 'topic' :
    $terms = wp_get_post_terms( $post_id , 'measure-topic', array('parent' => 0) );
    if ( !empty( $terms ) && !is_wp_error($terms) ){
      echo $terms[0]->name;
    }

    break;

    case 'subtopic' :
    $terms = wp_get_post_terms( $post_id , 'measure-topic', array('parent' => 0, 'fields' => 'ids') );
    $all_terms = wp_get_post_terms( $post_id , 'measure-topic', array('fields' => 'ids'));

    $result = array_diff($all_terms, $terms);

    $item = array_shift($result);
    $subtopic = get_term($item, 'measure-topic');

    if ( !empty( $subtopic ) && !is_wp_error($subtopic) ){
     echo ($subtopic->name);
   }

   break;

 }
}

function e11_measure_columns_list($columns) {
  $column_order = array(
    'cb' => $columns['cb'],
    'topic' => $columns['topic'],
    'subtopic' => $columns['subtopic'],
    'title' => 'Measure',
    'date' => $columns['date'],
  );
  return $column_order;

}
add_filter( 'manage_measure_posts_columns', 'e11_measure_columns_list' );
