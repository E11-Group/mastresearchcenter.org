<?php
$partners = get_field('partners', 'options');
$partnersLogos = $partners['partner_logos'];


if($partnersLogos): ?>
  <section class="partners">
    <div class="partners__container l-container">
      <h2 class="partners__title">Our Partners</h2>
      <div class="partners__row flexRow">
        <?php foreach($partnersLogos as $partner): ?>

          <div class="partner">
            <div class="partner__inner">
              <a <?php if(isset($partner['link']['target']) && $partner['link']['target'] == '_blank' ){ ?>target="_blank"<?php } ?> class="partner__logo" href="<?php echo $partner['link']['url']; ?>"><img src="<?php echo $partner['logo']['sizes']['large']; ?>" alt=""></a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<footer class="footer">
  <div class="footer__inner flexRow l-container">
    <div class="footer__logo"><a href="<?php echo home_url(); ?>" class="header__ logo"><img src="<?php echo get_stylesheet_directory_uri() . '/images/logo--MAST--white.svg'; ?>" alt="Marriage Center Logo" /></a></div>
    <div class="footer__navigation">
     <?php wp_nav_menu('menu=footer-navigation'); ?>
   </div>
   <div class="footer__social">
    <ul>
      <li><a href="<?php the_field('twitter_url', 'option'); ?>" target="_blank"><i class="icon icon--search"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__twitter.svg'); ?></i></a></li>
    </ul>
  </div>
</div>
</footer>
<footer class="copyrightFooter">
  <div class="l-container flexRow">
    <p><?php the_field('footer_copy', 'option'); ?></p>
    <p>&copy; Copyright <?php echo date('Y'); ?> Marriage Strengthening Research & Dissemination Center — All Rights Reserved</p>
  </div>
</footer>
<!--
<div id="modal" class="modal">
    <div class="modal__inner">
        <div class="close"><i>&times;</i></div>
        <div class="modal__content" id="signUpForm">
            <div class="modal__form">
                <?php //echo do_shortcode('[contact-form-7 id="411"]'); ?>
            </div>
        </div>
    </div>
  </div> -->
  <?php wp_footer(); ?>
  <?php if ( is_page_template('templates/template-evaluation.php') ) { ?>
    <script type="text/javascript">

      $(document).ready(function(){

        //Save Data Form
        $("#eva-saveform").submit(function(e){
          e.preventDefault();
          $email = $('#eva-email').val();
          $pageLink = $('#eva-link').val();
          var data = {
            'action' : 'measure',
            'email': $email,
            'page_link': $pageLink,
          };

          $.ajax({
            url:localized.ajaxurl,
            data : data,
            type : 'POST',
            success: function (data){
              $('.save-data__form').html(`<div class="email-success" style="display: block;width: 100%; text-align: center;"><p>Email sent successfully.</p></div>`);
            }
          });
        });

        //Ajax
        $(document).on('click',".toolkit-data-eva",function(e) {
          e.preventDefault();
          var status = $(this).attr("data-status");
          var dataValue = $(this).val();

          if (status == 'eva' ) {

            $(".save-data").hide();
            $('.ajax-container').find('.measure-topic').remove();
            $('.ajax-container').find('.measure-subtopic').remove();
            $('.ajax-container').find('.measure-data').remove();

            dataValue = $(this).attr("data-name");
            $('.evaluation-card').removeClass('active');
            $(this).closest('.evaluation-card').addClass("active");
          }
          msr_ajax(dataValue, status);
        });

        $(document).on("change",".toolkit-data",function(e) {
          e.preventDefault();
          $(".save-data").hide();
          var status = $(this).attr("data-status");
          var dataValue = $(this).val();
          var eva = '', eva_topic = '';
          if(status !='eva-subtopic'){
            $('.ajax-container').find('.measure-subtopic').remove();
            $('.ajax-container').find('.measure-data').remove();
          }
          if(status==='eva-subtopic'){
            $('.ajax-container').find('.measure-data').remove();
            eva = $('.evaluation-card.active .toolkit-data-eva').attr('data-name').trim();
            eva_topic = $('.toolkit-data[data-status="eva-topic"]:checked').val();
          }

          msr_ajax(dataValue, status, eva, eva_topic);
        });


      });

      function msr_ajax(dataValue, status, eva, eva_topic){
          var $notesLevelTwo = $('.hmre_genContent');

        var data = {
          'action' : 'measure_domain',
          'data_value' : dataValue,
          'status' : status,
          'eva': eva,
          'eva_topic': eva_topic
        };
        $.ajax({
          url:localized.ajaxurl,
          data : data,
          type : 'POST',
          beforeSend: function() {
            $(".loading").show();
          },
          success: function (topic){
           $(".loading").hide();
           if (status === 'eva') {
            let topichtml = `<div class="measure-topic checkbox-block">
            <div class="container">
            <h2 class="measure-subtopic__title levelTwo__heading">Choose a specific topic</h2>${topic}</div></div>`;
            $('.ajax-container').find('.measure-topic').remove();
            $('.ajax-container').find('.measure-subtopic').remove();
            $('.ajax-container').find('.measure-data').remove();
            $('.ajax-container').append(topichtml);
            $(".save-data").hide();
            if($notesLevelTwo) {
                var $notesLevelTwoClone = $notesLevelTwo.clone();
                $notesLevelTwoClone.insertAfter($('.levelTwo__heading'));
            }
          }
          else if (status === 'eva-topic') {
            let topichtml = `<div class="measure-subtopic checkbox-block">
            <div class="container">
            <h2 class="measure-subtopic__title">Choose a Subtopic</h2>${topic}</div></div>`;
            $('.ajax-container').find('.measure-subtopic').remove();
            $('.ajax-container').find('.measure-data').remove();
            $('.ajax-container').append(topichtml);
            $(".save-data").hide();

          } else if (status === 'eva-subtopic') {
            let topichtml = `<div class="measure-data">
            <div class="container">
            <h2 class="measure-data__title">Data...</h2>${topic}</div></div>`;
            $('.ajax-container').find('.measure-data').remove();
            $('.ajax-container').append(topichtml);

            $(".save-data").show();
            $link = window.location.origin + window.location.pathname + '?eva=' + eva + '&tp=' + eva_topic + '&stp=' + dataValue;
            $("#eva-saveform .save-data__link").val($link);
          }
        }
      });
      }

    </script>
  <?php } ?>
</body>
</html>
