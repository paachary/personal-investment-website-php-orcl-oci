<?php $successMessage = Session::getFlashMessage('success_message'); ?>
<?php if ($successMessage !== null) : ?>
  <div class="success-message">
    <?= $successMessage ?>
  </div>
<?php endif; ?>

<?php $errorMessage = Session::getFlashMessage('error_message'); ?>
<?php if ($errorMessage !== null) : ?>
  <div class="error-message">
    <?= $errorMessage ?>
  </div>
<?php endif; ?>