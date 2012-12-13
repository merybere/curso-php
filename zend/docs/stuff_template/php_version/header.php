<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 *
 * Header of the page. Use CONFIGURATION section to adjust main template
 * settings and behaviors as you need.
 */
?>
<?php require_once 'php/schemeswitcher.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

  <!-- BEGIN HEAD -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <!-- BEGIN CONFIGURATION -->
    <title>Stuff</title>                      <!-- site title -->
    <style type="text/css">
      #menu { width: 250px; }                 /* left menu section width */
      #content { left: 250px; }               /* space between left edge of the browser's window and content (it should be equal or bigger then menu section width) */
    </style>
    <script type="text/javascript">
      stuff_config = {
        middlePoint: 310,                     // distance from page top to post thumbnail's center
        portfolioGalleryChangeEffect: 'fade', // portfolio's gallery transition effect (sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random)
        portfolioGalleryChangeSpeed: 150,     // transition speed
        portfolioGalleryNavOnHover: true,     // show navigation arrows only for mouse hover
        columnSupport: true,                  // content coulmns creating
        columnPageChangeSpeed: 'normal',      // change page animation speed (fast, normal, slow)
        mouseWheelSupport: true               // support for horizontal mouse scrolling
      }
    </script>
    <!-- END CONFIGURATION -->

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="style.min.css" />
    <link rel="stylesheet" type="text/css" media="all" href="schemes/<?php echo $scheme; ?>/style.css" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" href="ie7.min.css" type="text/css" media="screen" />
    <![endif]-->
    <link rel="icon" type="image/png" href="schemes/<?php echo $scheme; ?>/images/favicon.png" />
    <script type="text/javascript" src="schemes/<?php echo $scheme; ?>/style.js"></script>
    <!-- Java Scripts used in the template - not combined version.
         Delete this code section if you don't need that. -->
    <!--
    <script type="text/javascript" src="js/scripts/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="js/scripts/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript" src="js/scripts/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="js/scripts/autocolumn.min.js"></script>
    <script type="text/javascript" src="js/scripts/cufon-yui.js"></script>
    <script type="text/javascript" src="js/scripts/league_gothic.font.js"></script>
    <script type="text/javascript" src="js/scripts/stuff.js"></script>
    -->
    <script type="text/javascript" src="js/stuff.allinone.min.js"></script>
  </head>
  <!-- END HEAD -->

  <!-- BEGIN BODY -->
  <body>

    <!-- BEGIN IMAGE PRELOADER -->
    <div id="image-preloader">
      <div class="search-background"></div>
      <div class="search-submit"></div>
      <div class="loader"></div>
    </div>
    <!-- END IMAGE PRELOADER -->

    <!-- BEGIN BROWSER NOTIFICATION -->
    <div class="browser-notification ie6">
      <div class="text">
        Your browser (Internet Explorer 6) is <strong>out of date</strong>. It has known <strong>security flaws</strong> and may <strong>not display all features</strong> of this and other websites. <a href="http://www.browser-update.org/update.html">Learn how to update your browser</a>.
      </div>
      <div class="close">X</div>
    </div>
    <noscript>
      <div class="browser-notification js">
        <div class="text">
          Your browser does not support JavaScript, or you do not have it enabled. <strong>Please enable JavaScript</strong> or the site will not work properly.
        </div>
      </div>
    </noscript>
    <!-- END BROWSER NOTIFICATION -->

    <!-- BEGIN WRAPPER -->
    <div id="wrapper">

      <!-- BEGIN SCHEME SWITCHER -->
      <div id="scheme-switcher">
        <ul class="schemes">
          <li><a href="?scheme=bright-blue" title="Bright - blue" style="background-position: -0px 0;"></a></li>
          <li><a href="?scheme=bright-gray" title="Bright - gray" style="background-position: -24px 0;"></a></li>
          <li><a href="?scheme=bright-green" title="Bright - green" style="background-position: -48px 0;"></a></li>
          <li><a href="?scheme=bright-pink" title="Bright - pink" style="background-position: -72px 0;"></a></li>
          <li><a href="?scheme=bright-red" title="Bright - red" style="background-position: -96px 0;"></a></li>
          <li><a href="?scheme=bright-yellow" title="Bright - yellow" style="background-position: -120px 0;"></a></li>
          <li><a href="?scheme=dark-blue" title="Dark - blue" style="background-position: -144px 0;"></a></li>
          <li><a href="?scheme=dark-green" title="Dark - green" style="background-position: -168px 0;"></a></li>
          <li><a href="?scheme=dark-orange" title="Dark - orange" style="background-position: -192px 0;"></a></li>
          <li><a href="?scheme=dark-pink" title="Dark - pink" style="background-position: -216px 0;"></a></li>
          <li><a href="?scheme=dark-white" title="Dark - white" style="background-position: -240px 0;"></a></li>
          <li><a href="?scheme=dark-yellow" title="Dark - yellow" style="background-position: -264px 0;"></a></li>
        </ul>
        <div class="clear"></div>
        <a class="select">Select skin</a>
      </div>
      <!-- END SCHEME SWITCHER -->

      <!-- BEGIN MENU -->
      <div id="menu">

        <!-- BEGIN MASK -->
        <div class="mask"></div>
        <!-- END MASK -->

        <!-- BEGIN SOCIAL MEDIA -->
        <ul id="social-media">
          <li><a href="#null" title="Flickr"><img src="images/socialmedia/<?php echo $variant; ?>/flickr.png" alt="" /></a></li>
          <li><a href="#null" title="Twitter"><img src="images/socialmedia/<?php echo $variant; ?>/twitter.png" alt="" /></a></li>
          <li><a href="#null" title="Facebook"><img src="images/socialmedia/<?php echo $variant; ?>/facebook.png" alt="" /></a></li>
          <li><a href="#null" title="LinkedIn"><img src="images/socialmedia/<?php echo $variant; ?>/linkedin.png" alt="" /></a></li>
        </ul>
        <!-- END SOCIAL MEDIA -->

        <!-- BEGIN CONTAINER -->
        <div class="container">

          <!-- BEGIN LOGO -->
          <div id="logo" class="arrow">
            <div class="image">
              <img src="schemes/<?php echo $scheme; ?>/images/logo.png" alt="Stuff" width="137" height="67" />
            </div>
            <a href="index.php" title="Stuff" class="mask"></a>
          </div>
          <!-- END LOGO -->

          <!-- BEGIN NAVIGATION MENU -->
          <div id="nav-menu">
            <div class="arrow up"><div></div></div>
            <div class="container">
              <ul>
                <?php
                  $request = trim( $_SERVER['REQUEST_URI'] );
                  $menu = array
                  (
                    'custom_page.php' => 'Page',
                    'three_column_page.php' => '3 columns',
                    'portfolio_big.php' => 'Portfolio XL',
                    'portfolio_small.php' => 'Portfolio M',
                    'contact.php' => 'Contact'
                  );
                  foreach ( $menu as $url => $name ):
                ?>
                <li<?php if ( strstr( $request, '/'.$url ) !== FALSE ) echo ' class="current"'; ?>>
                  <a href="<?php echo $url; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a>
                </li>
                <?php endforeach; ?>
                <li class="search">
                  <a title="Search">Search</a><br />
                  <form action="search.php" method="post">
                    <div>
                      <input type="text" name="s" />
                      <input type="submit" value="" />
                    </div>
                  </form>
                </li>
              </ul>
            </div>
            <div class="arrow down"><div></div></div>
          </div>
          <!-- END NAVIGATION MENU -->

        </div>
        <!-- END CONTAINER -->

      </div>
      <!-- END MENU -->

      <!-- BEGIN CONTENT -->
      <div id="content">