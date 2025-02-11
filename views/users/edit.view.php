<?php
$user = Session::get('user');
Session::set('BACK', '/accounts');
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Update User</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?= loadPartial("header") ?>
		<div class="form-container">
	<h2 class="h2">Update User
		<hr>
	</h2>

		<form method="post" action="/users/edit">
			<div class="user-input">
				<div class="flex-container-create-account">
					<div class="sub-container">
						<label class="label-text">Phone Number</label>
						<input name="phoneNumber" type="text" class="text" id="phoneNumber" title="Phone Number" value="<?= $user['phoneNumber'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="emailId" class="label-text">Email Id</label>
						<input name="emailId" type="text" class="text" id="emailId" title="emaiId" value="<?= $user['emailId'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="contactaddress" class="label-text">Address</label>
						<input name="contactaddress" type="text" class="text" id="contactaddress" title="Contact Address" value="<?= $user['contactaddress'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="city" class="label-text">City</label>
						<input name="city" type="text" class="text" id="city" title="city" value="<?= $user['city'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="pincode" class="label-text">Pin</label>
						<input name="pincode" type="text" class="text" id="pincode" title="pincode" value="<?= $user['pincode'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
				</div>
			</div>
			<?= loadPartial("createButton") ?>
		</form>
	</div>

</body>

</html>