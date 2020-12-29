<?php  if (count($errors) > 0) : ?>
  <div class="msg" style="margin-top: 10px; font-size: 14px; color: red;">
   <?php foreach ($errors as $error) : ?>
     <span>(*) <?php echo $error ?></span>
   <?php endforeach ?>
  </div>
<?php  endif ?>