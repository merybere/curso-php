<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 *
 * This file is responsible for deliver content for post, called by AJAX.
 * The PHP code in this file is an example - you should adjust it to your site's
 * needs and method of content geting.
 *
 * If you don't want to use AJAX technology you can put the HTML code from here
 * directly in the blog page (index.php file) instead of using initBox() method.
 * Or you can mix the methods (default content plus dynamic getting content).
 */
?>
<?php
  require_once 'example_posts.php';
  $id = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
  for ( $i = $id; $i < min( $id+5, count( $posts ) ); $i++ ):
    extract( $posts[$i] );
    if ( ! preg_match( '/^<p>.+<\/p>$/i', $excerpt ) )
    {
      $excerpt = "<p>{$excerpt}</p>";
    }
?>

<!-- BEGIN POST -->
<div class="box">
  <div class="container">
    <div class="title">
      <div class="meta">
        <p class="comments-count"><a href="<?php echo $url; ?>#comments" title="<?php echo $comments; ?> comments"><span><?php echo $comments; ?></span> comments</a></p>
        <p class="author"><a href="#null" title="<?php echo $author; ?>"><?php echo $author; ?></a></p>
        <p><?php echo $categories; ?></p>
        <p><?php echo $date; ?></p>
      </div>
      <div class="top"></div>
      <h2><a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title ?></a></h2>
    </div>
    <div class="thumbnail">
      <a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
        <img src="content/<?php echo $thumbnail; ?>" alt="" />
        <span class="badge<?php echo rtrim( ' '.$badge ); ?>"></span>
      </a>
    </div>
    <div class="excerpt">
      <?php echo $excerpt; ?>
    </div>
    <div class="bottom"></div>
    <a href="<?php echo $url; ?>" title="Read more" class="more">Read more</a>
  </div>
</div>
<!-- END POST -->

<?php endfor; ?>