<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.0
 */
?>
<?php require_once 'header.php'; ?>

<!-- BEGIN PAGE -->
<div class="box wide">
  <div class="container">
    <div class="top"></div>
    <div class="title">
      <h2>Contact me</h2>
    </div>
    <div class="content">
      <h4>Working out of&nbsp;the box contact form</h4>
      <p>Nulla malesuada. In&nbsp;hendrerit dolor non luctus elit, ut&nbsp;leo. Integer mi&nbsp;libero, consectetuer lectus, volutpat ut, metus. Etiam varius, nisl nulla dolor leo felis tincidunt in, commodo ipsum dolor auctor neque quis enim aliquam risus et&nbsp;ultrices nulla. Fusce dui eget est a&nbsp;urna. Nam quis justo. Suspendisse adipiscing elit. Mauris id&nbsp;purus vitae quam. Nulla pellentesque facilisis. Fusce consequat urna. Curae, Duis at&nbsp;porta ligula non diam. In&nbsp;vitae massa. Maecenas viverra accumsan, libero dolor, scelerisque urna ante, sagittis vel, ipsum. Aliquam nec tellus. Nunc a&nbsp;arcu.</p>
      <form action="php/sendmail.php" method="post" class="contact">
        <p class="input"><input type="text" name="author" />Name*</p>
        <p class="input"><input type="text" name="email" />EMail*</p>
        <p class="input"><input type="text" name="subject" />Subject</p>
        <p class="textarea"><textarea name="message" rows="5" cols="15"></textarea></p>
        <div class="submit">Send<a title="Send"></a></div>
        <div class="loader"></div>
        <div class="status"></div>
        <div class="clear"></div>
      </form>
    </div>
    <div class="bottom"></div>
  </div>
</div>
<!-- END PAGE -->

<?php require_once 'footer.php'; ?>