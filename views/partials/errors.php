<?php if (isset($errors)) : ?>
  <?php foreach ($errors as $error) : ?>
    <div class="message"><?= $error ?></div>
  <?php endforeach; ?>
<?php endif; ?>