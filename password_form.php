<h3><?php echo $form_head; ?></h3>
<?php if ($delete === true):
  // Delete page only gets two fields and is a get. I didn't want to
  // do a get with the delete form because of autocomplete in the url bar.
?>
  <form action="<?php echo $form_action; ?>" method="post">
    <?php echo $form_text; ?><br />
    <input id="pass" name="pass" autofocus="autofocus" type="password" /><br /><br />
    Deleting these results is permanent. You must positively affirm that you wish to do
    that by typing "delete" below.<br /><br />
    <input id="delete" name="delete"><br /><br />
<?php else: ?>
  <form action="<?php echo $form_action; ?>" method="post">
    <?php echo $form_text; ?><br />
    <input id="pass" name="pass" autofocus="autofocus" type="password" /><br /><br />
<?php endif; ?>
  <input type="submit" value="<?php echo $submit_text; ?>" />
</form>
