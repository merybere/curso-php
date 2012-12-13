<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 *
 * This file is responsible for deliver content for portfolio item, called by AJAX.
 * The PHP code in this file is an example - you should adjust it to your site's
 * needs and method of content geting.
 *
 * If you don't want to use AJAX technology you can put the HTML code from here
 * directly in the portfolio page (portfolio_big.php or portfolio_small.php file)
 * instead of using initBox() method. Or you can mix the methods
 * (default content plus dynamic getting content).
 */
?>
<?php
  require_once 'example_items.php';
  $type = isset( $_POST['type'] ) ? $_POST['type'] : 'big';
  $id = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
  for ( $i = $id; $i < min( $id+( $type == 'big' ? 2 : 5 ), count( $items ) ); $i++ ):
    extract( $items[$i] );
    $thumbnail_type = is_array( $gallery ) ? 'gallery' : 'video';
    if ( ! preg_match( '/^<p>.+<\/p>$/i', $excerpt ) )
    {
      $excerpt = "<p>{$excerpt}</p>";
    }
    if ( $type == 'big' ):
?>

<!-- BEGIN ITEM -->
<div class="box wide">
  <div class="container">
    <div class="top"></div>
    <div class="thumbnail <?php echo $thumbnail_type; ?>">
      <?php
        if ( is_array( $gallery ) ):
          foreach ( $gallery as $image ):
      ?>
      <a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
        <img src="content/<?php echo $image; ?>" alt="" />
      </a>
      <?php
          endforeach;
        else:
          echo $gallery;
        endif;
      ?>
    </div>
    <div class="meta">
      <p class="website"><a href="#null"><?php echo $webiste; ?></a></p>
      <p class="author"><a href="#null" title="<?php echo $author; ?>"><?php echo $author; ?></a></p>
      <p><?php echo $categories; ?></p>
      <p><?php echo $tags; ?></p>
    </div>
    <div class="title">
      <h2><a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h2>
    </div>
    <div class="clear"></div>
    <div class="bottom"></div>
  </div>
</div>
<!-- END ITEM -->

<?php else: ?>

<!-- BEGIN ITEM -->
<div class="box">
  <div class="container">
    <div class="title">
      <div class="meta">
        <p class="website"><a href="#null"><?php echo $webiste; ?></a></p>
        <p class="author"><a href="#null" title="<?php echo $author; ?>"><?php echo $author; ?></a></p>
        <p><?php echo $categories; ?></p>
        <p><?php echo $tags; ?></p>
      </div>
      <div class="top"></div>
      <h2><a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title ?></a></h2>
    </div>
    <div class="thumbnail gallery">
      <a href="<?php echo is_array( $gallery ) ? 'content/'.$gallery[0] : '#portfolio-item-sub-gallery-'.$i; ?>" title="<?php echo $title; ?>" rel="portfolio-item-<?php echo $i; ?>">
        <img src="content/<?php echo $thumbnail; ?>" alt="" />
        <span class="badge<?php echo rtrim( ' '.$badge ); ?>"></span>
      </a>
      <div id="portfolio-item-sub-gallery-<?php echo $i; ?>" class="sub-gallery">
        <?php
          if ( is_array( $gallery ) ):
            array_shift( $gallery );
            foreach ( $gallery as $image ):
        ?>
        <a href="content/<?php echo $image; ?>" rel="portfolio-item-<?php echo $i; ?>"></a>
        <?php
            endforeach;
          else:
            echo $gallery;
          endif;
        ?>
      </div>
    </div>
    <div class="excerpt">
      <?php echo $excerpt; ?>
    </div>
    <div class="bottom"></div>
    <a href="<?php echo $url; ?>" title="See more" class="more">See more</a>
  </div>
</div>
<!-- END ITEM -->

<?php endif; endfor; ?>