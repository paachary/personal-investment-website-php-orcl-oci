<?php
$user = Session::get('user');
Session::set('BACK', '/');
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Reset Password</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?= loadPartial("header") ?>
  <div class="form-container">
    <h2 class="h2">Reset Password
      <hr>
    </h2>

    <form method="post" action="/users/passwordReset">
      <div class="user-input">
        <div class="flex-container-create-account">
          <?= loadPartial('errors', [
            'errors' => $errors ?? []
          ]) ?>
          <div class="message hidden" id="message"></div>
          <div class="sub-container">
            <label for="password" class="label-text">Existing Password</label>
            <input name="password" type="password" autofocus="autofocus" class="text" id="password" tabindex="1" title="Existing Password" value="" size="60px" maxlength="80px">
          </div>
          <div class="sub-container">
            <label for="newpassword" class="label-text">New Passwword</label>
            <input name="newpassword" type="password" class="text" id="newpassword" tabindex="2" title="New Password" value="" size="60px" maxlength="80px">
          </div>
          <div class="sub-container">
            <label for="confirmnewpassword" class="label-text">Confirm Password</label>
            <input name="confirmnewpassword" type="password" class="text" id="confirmnewpassword" tabindex="3" title="Confirm New Password" value="" size="60px" maxlength="80px">
          </div>
        </div>
      </div>
      <?= loadPartial("createButton") ?>
    </form>
  </div>

</body>

</html>