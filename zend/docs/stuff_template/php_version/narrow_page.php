<?php
/**
 * @package Stuff_Template
 * @since Stuff 1.1
 */
?>
<?php require_once 'header.php'; ?>

<!-- BEGIN POST PAGE -->
<div class="box high">
  <div class="container">
    <div class="meta">
      <p class="comments-count"><span>2</span> comments</p>
      <p class="author"><a href="#null" title="kubasto">kubasto</a></p>
      <p>Category one, Category two</p>
      <p>First tag, Second tag</p>
      <p>September 3, 2010</p>
    </div>
    <div class="title">
      <h2>Example short post</h2>
    </div>
    <div class="content">
      <div class="columns two">
        <p>Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et&nbsp;magnis dis parturient montes, nascetur ridiculus mus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
        <h4>Vivamus elementum semper nisi</h4>
        <p>Phasellus viverra nulla ut&nbsp;metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies. Maecenas tempus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et&nbsp;ante tincidunt tempus.</p>
        <p>Donec vitae sapien ut&nbsp;libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi&nbsp;a&nbsp;libero.</p>
        <hr />
        <p>Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in&nbsp;dui. Cras ultricies mi&nbsp;eu&nbsp;turpis hendrerit fringilla. Vestibulum ante ipsum primis in&nbsp;faucibus orci luctus et&nbsp;ultrices posuere cubilia Curae; In&nbsp;ac dui quis mi&nbsp;consectetuer lacinia. Nam pretium turpis et&nbsp;arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum.</p>
        <h4>Integer ante arcu</h4>
        <p>Sed aliquam ultrices mauris. Integer ante arcu, accumsa, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id&nbsp;dui. Phasellus nec sem in&nbsp;justo pellentesque facilisis.</p>
      </div>
    </div>
    <div class="nav-page">
      <a title="Previous" class="prev">&lt; Prev</a>
      <span class="pages"></span>
      <a title="Next" class="next">Next &gt;</a>
    </div>
  </div>
</div>
<!-- END POST PAGE -->

<!-- BEGIN COMMENTS -->
<div id="comments">
  <ul class="list">
    <li class="comment">
      <div class="top"><div></div></div>
      <div class="middle">
        <div class="content">
          <p>Nam scelerisque justo a&nbsp;leo nec justo vel neque vel nulla. Proin lacus. Duis sed fermentum erat. Fusce non orci. Nam consectetuer adipiscing at, egestas consequat lacus ipsum non purus.</p>
        </div>
        <div class="tools">
          <a href="#null">quote</a> |
          <a href="#null">reply</a>
        </div>
        <div class="meta">
          <p class="author"><a href="#null" title="nickname surname">nickname surname</a></p>
          <p class="timestamp">22:13<br />11/08/2010</p>
        </div>
      </div>
      <div class="bottom"><div></div></div>
    </li>
    <li class="comment">
      <div class="top"><div></div></div>
      <div class="middle">
        <div class="content">
          <p>Vivamus fermentum eget, congue et, nonummy sed, urna. Donec iaculis. Nam dolor sit amet, accumsan ullamcorper massa et&nbsp;ultrices posuere sit amet nunc.</p>
        </div>
        <div class="tools">
          <a href="#null">quote</a> |
          <a href="#null">reply</a>
        </div>
        <div class="meta">
          <img src="schemes/<?php echo $scheme; ?>/images/avatar.png" alt="" class="avatar" />
          <p class="author"><a href="#null" title="somebody">somebody</a></p>
          <p class="timestamp">08:45<br />12/08/2010</p>
        </div>
      </div>
      <div class="bottom"><div></div></div>
    </li>
    <li class="comment-form">
      <h4>Leave a comment</h4>
      <form action="" method="post">
        <p class="input"><input type="text" name="author" />Name*</p>
        <p class="input"><input type="text" name="email" />EMail*</p>
        <p class="input"><input type="text" name="url" />WWW</p>
        <p class="textarea"><textarea name="comment" rows="5" cols="15"></textarea></p>
        <div class="submit">Submit comment<a title="Submit comment"></a></div>
        <div class="clear"></div>
      </form>
    </li>
  </ul>
</div>
<!-- END COMMENTS -->

<?php require_once 'footer.php'; ?>