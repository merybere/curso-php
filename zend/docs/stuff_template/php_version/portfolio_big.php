<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 *
 * First type portfolio. It consist JavaScript funcion called initBox()
 * which initailize process of adding content blocks.
 * Read more amout this in the template's documentation.
 */
?>
<?php require_once 'header.php'; ?>

<?php
  $_POST['type'] = 'big';
  require_once 'item.php'; // loading first pack of items to avoid calling loading event just after page load
?>
<script type="text/javascript">
  initBox({
    requestURL: 'item.php',
    params: {type: 'big'},
    limit: 100
  });
</script>

<?php require_once 'footer.php'; ?>