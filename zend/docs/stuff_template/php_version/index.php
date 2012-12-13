<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 *
 * Page of site's blog. It consist JavaScript funcion called initBox()
 * which initailize process of adding content blocks.
 * Read more amout this in the template's documentation.
 */
?>
<?php require_once 'header.php'; ?>

<?php
  require_once 'post.php'; // loading first pack of posts to avoid calling loading event just after page load
?>
<script type="text/javascript">
  initBox({
    requestURL: 'post.php',
    limit: 100
  });
</script>

<?php require_once 'footer.php'; ?>