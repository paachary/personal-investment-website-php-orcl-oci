<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Register User</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<header class="header-new-reg">
		<div class="logo">
			<a href="/">
				<img src="/images/my-finances.jpg" alt="My Finances Logo" width="640" height="427" title="My Finances Logo" />
			</a>
		</div>
		<div class="header-text">User Registration</div>
		<div class="register-user">Have an account?
			<a class="register-user-link" href="/auth/login">Login</a>
		</div>
	</header>
	<div class="form-container">
		<form method="post" action="/auth/register">
			<div class="user-input">
				<div class="flex-container-create-account">
					<?= loadPartial('errors', [
						'errors' => $errors ?? []
					]) ?>
					<div class="message hidden" id="message"></div>
					<h4>ID Information</h4>
					<input name="userName" type="text" required="required" class="text" id="userName" placeholder="User Name" tabindex="1" title="User Name" size="60px" maxlength="80px" value="<?= $user['userName'] ?? '' ?>">
					<input name="password" type="password" class="text" id="password" placeholder="password" tabindex="2" title="Password">
					<hr class="reg-user-hr">
					<input name="confirmPassword" type="password" class="text" id="confirmPassword" placeholder="confirm password" tabindex="3" title="Confirm Password">

					<h4>Personal Information</h4>
					<input name="firstName" type="text" required="required" class="text" id="firstName" placeholder="First Name" tabindex="4" title="First Name" size="60px" maxlength="80px" value="<?= $user['firstName'] ?? '' ?>">
					<input name="lastName" type="text" required="required" class="text" id="lastName" placeholder="Last Name" tabindex="5" title="Last Name" size="60px" maxlength="80px" value="<?= $user['lastName'] ?? '' ?>">
					<input name="dateofbirth" type="date" class="text" id="dateofbirth" tabindex="6" title="Date of Birth" value="<?= $user['dateofbirth'] ?? '' ?>">
					<input name="genderCheck" id="genderCheck" hidden value="<?= $user['gender'] ?? '' ?>">
					<div class="gender" id="gender">
						<label class="gender-label">
							<input name="gender" type="radio" id="gender_0" tabindex="7" title="Female" value="F" checked="checked">
							Female
						</label>
						<label class="gender-label">
							<input name="gender" type="radio" id="gender_1" tabindex="8" title="Male" value="M">
							Male
						</label>
					</div>
					<hr class="reg-user-hr">

					<h4>Demographic Information</h4>
					<input name="phoneNumber" type="number" required="required" class="text" id="phoneNumber" placeholder="Phone Number" tabindex="9" title="Phone Number" size="60px" maxlength="80px" value="<?= $user['phoneNumber'] ?? '' ?>">
					<input name="emailId" type="text" required="required" class="text" id="emailId" placeholder="Email Id" tabindex="10" title="emaiId" size="60px" maxlength="80px" value="<?= $user['emailId'] ?? '' ?>">
					<input name="contactaddress" type="text" required="required" class="text" id="contactaddress" placeholder="Contact Address" tabindex="11" title="Contact Address" value="<?= $user['contactaddress'] ?? '' ?>">
					<input name="city" type="text" required="required" class="text" id="city" placeholder="City" tabindex="12" title="city" size="60px" maxlength="80px" value="<?= $user['city'] ?? '' ?>">
					<input name="pincode" type="number" required="required" class="text" id="pincode" placeholder="Pin Code" tabindex="13" title="pincode" size="60px" maxlength="80px" value="<?= $user['pincode'] ?? '' ?>">
				</div>
				<?php loadPartial('createButton'); ?>
			</div>

		</form>
	</div>
	<script src=" /scripts/registerUser.js"></script>
</body>

</html>