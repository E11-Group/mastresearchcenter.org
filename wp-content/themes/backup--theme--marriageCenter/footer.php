<?php
$partners = get_field('partners', 'options');
$partnersLogos = $partners['partner_logos'];


if($partnersLogos && !is_front_page()): ?>
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

<div id="modal" class="modal">
    <div class="modal__inner">
        <div class="close"><i>&times;</i></div>
        <div class="modal__content" id="signUpForm">
            <div class="modal__form">
                <?php echo do_shortcode('[contact-form-7 id="411"]'); ?>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
