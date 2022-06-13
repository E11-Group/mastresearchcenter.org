<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php
    // Use js/development/after-libs/web-font-loader.js to load fonts.
    ?>

    <?php
    // Common prefetches
    // <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    // <link rel="dns-prefetch" href="https://ajax.googleapis.com">
    // <link rel="dns-prefetch" href="https://www.google-analytics.com">
    // <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    // <link rel="dns-prefetch" href="https://use.typekit.net">
    ?>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php /*
    <!-- http://realfavicongenerator.net/ -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#45a9ba">
    <meta name="theme-color" content="#ffffff">
    */ ?>

    <?php /*
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155338936-1"></script>

    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-155338936-1');
    </script>

    */ ?>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K6TGRM9');</script>
    <!-- End Google Tag Manager -->


    <?php if(is_bbpress()): ?>
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/styles/css/bootstrap.css?v=<?php echo time(); ?>">
    <?php endif; ?>

    <?php
    ### Set up critical and non critical CSS.
    do_action('jp_css');
    ?>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6TGRM9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php do_action('jp_body_start'); ?>

<?php
$headerImage = get_field('header_image');
if($headerImage){
    if(is_front_page()){
        $headerImage = $headerImage['sizes']['1080p'];
    } else {
        $headerImage = $headerImage['sizes']['header_image'];
    }
} else {

    if ( is_post_type_archive( 'research' ) ) {
        $researchHero = get_field('research_hero_image', 'option');
        if($researchHero != ''){
            $headerImage = $researchHero;
        } else {
            $defaultHero = get_field('default_hero_image', 'option');
            if($defaultHero != ''){
                $headerImage = $defaultHero;
            } else {
                $headerImage = '';
            }
        }
    } elseif ( is_post_type_archive( 'resources' ) ) {
        $resourcesHero = get_field('resource_hero_image', 'option');
        if($resourcesHero != ''){
            $headerImage = $resourcesHero;
        } else {
            $defaultHero = get_field('default_hero_image', 'option');
            if($defaultHero != ''){
                $headerImage = $defaultHero;
            } else {
                $headerImage = '';
            }
        }
    } else {
        $defaultHero = get_field('default_hero_image', 'option');
        if($defaultHero != ''){
            $headerImage = $defaultHero;
        } else {
            $headerImage = '';
        }
    }
}
?>

<header class="header <?php if(is_front_page()){ echo 'home'; } ?>" style="background-image: url(<?php echo $headerImage; ?>">
    <div class="header__container l-container">
        <div class="header__utilityNavigation">
            <ul class="header__utilityNavigation__inner">
                <?php 
                /*
                $currentUser = wp_get_current_user();
                if( is_user_logged_in() ): ?>
                    <li><a href="<?php echo bbp_get_user_profile_url( get_current_user_id() ); ?>"><?php echo $currentUser->user_login; ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo get_home_url(); ?>/forums/forum/marriage-center-forum/">Forum Sign-In</a></li>
                <?php endif; ?>
                */?>
                <li class="header__utilityNavigation__search"><a href="#search"><i class="icon icon--search"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__search.svg'); ?></i> Search</a></li>
            </ul>
        </div>
        <div class="flexRow header__inner">
            <div class="header__logo">
                <a href="<?php echo home_url(); ?>" class="header__ logo"><img src="<?php echo get_stylesheet_directory_uri() . '/images/logo--MAST2020.svg'; ?>" alt="Marriage Center Logo" /></a>
            </div>

            <button class="hamburger hamburger--stand" type="button" aria-label="Menu" aria-controls="navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>

            <div class="header__navigation">
                <?php wp_nav_menu('menu=main-navigation'); ?>
            </div>
        </div>
        <div id="searchBar" class="header__search">
            <?php echo get_search_form(); ?>
        </div>
    </div>
    
    <?php
    if(is_front_page()): ?>
        <?php
        $heroText = get_field('hero_text');
        $heroText__title = $heroText['title'];
        $heroText__description = $heroText['description'];
        $heroText__link = $heroText['link'];
        $heroText__linkText = $heroText['link_text'];
        ?>
        <?php if($heroText): ?>
            <div class="header__intro">
                <div class="header__intro__inner">
                    <h2 class="header__intro__title"><?php echo $heroText__title; ?></h2>
                    <div class="header__intro__content"><?php echo $heroText__description; ?></div>
                    <a href="<?php echo $heroText__link; ?>" class="header__intro__cta button button--light"><?php echo $heroText__linkText; ?></a>
                </div>
                <div class="header__intro__followUs">
                    <label for="">Follow Us</label>
                    <ul>
                        <?php /*<li><a href="#"><i class="icon icon--search"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__facebook.svg'); ?></i></a></li>*/?>           
                        <li><a target="_blank" href="https://twitter.com/MASTResearchCtr"><i class="icon icon--search"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__twitter.svg'); ?></i></a></li>
                        <li><a href="#" data-modal-id="signUpForm"><i class="icon icon--search"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__email.svg'); ?></i></a></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</header>
