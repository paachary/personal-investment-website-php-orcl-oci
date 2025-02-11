<?php
$user = Session::get('user');
Session::set('BACK', '/');
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Forgot Password</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <header class="header-new-reg">
    <div class="logo">
      <a href="/">
        <img src="/images/my-finances.jpg" alt="My Finances Logo" width="640" height="427" title="My Finances Logo" />
      </a>
    </div>
    <div class="header-text">User Login</div>
    <div></div>
  </header>
  <div class="form-container">
    <h2 class="h2">Forgot Password
      <hr>
    </h2>

    <form method="post" action="/users/forgotPassword">
      <div class="user-input">
        <div class="flex-container-create-account">
          <?= loadPartial('errors', [
            'errors' => $errors ?? []
          ]) ?>
          <div class="message hidden" id="message"></div>
          <div class="sub-container">
            <label for="userName" class="label-text">Registered Username</label>
            <input name="userName" type="text" autofocus="autofocus" class="text" id="userName" tabindex="1" title="Registered Username" value="" size="60px" maxlength="80px">
          </div>

          <div class="sub-container">
            <label for="email" class="label-text">Registered Email</label>
            <input name="email" type="email" autofocus="autofocus" class="text" id="email" tabindex="1" title="Registered Email" value="" size="60px" maxlength="80px">
          </div>
        </div>
      </div>
      <?= loadPartial("createButton") ?>
    </form>
  </div>

</body>

</html>