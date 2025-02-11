<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login User</title>
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
	<div class="login">
		<h3>Login</h3>

		<div class="flex-container-create-account">
			<?= loadPartial('errors', [
				'errors' => $errors ?? []
			]) ?>
			<form action="/auth/login" method="post" class="user-login">
				<div class="login-input">
					<label class="login-labels label-text">User Name</label>
					<input name="userName" type="text" autofocus="autofocus" class="text" id="userName" placeholder="user name" tabindex="1" title="User Name" size="50" maxlength="80">
				</div>
				<div class="login-input">
					<label class="login-labels label-text">Password</label>
					<input name="password" type="password" class="text" id="password" placeholder="password" tabindex="2" title="Password" size="50" maxlength="80">
				</div>
				<div class="login-btns">
					<input name="login" type="submit" class="login-btn" id="login" title="Login" value="Login">
					<div class="forgot-pwd">
						<a class="fwd-pwd-lnk" href="/users/forgotPassword">Forgot Password</a>
					</div>
					<div class="register-user">Don't have an account?
						<a class="register-user-link" href="/auth/register">Sign Up</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>