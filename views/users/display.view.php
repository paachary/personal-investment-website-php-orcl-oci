<?php
$user = Session::get('user');
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>User Details</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?= loadPartial("header") ?>
		<div class="form-container">
	<h2 class="h2">User Details
		<hr>
	</h2>
	<?php loadPartial("message"); ?>

		<form method="post" action="/auth/register">
			<div class="user-input">
				<div class="flex-container-create-account">
					<div class="sub-container">
						<label for="Name" class="label-text">Name</label>
						<input name="name" type="text" disabled="disabled" class="text" id="name" title="Name" value="<?= $user['firstName'] . ' ' . $user['lastName'] ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label class="label-text">Date Of Birth</label>
						<input name="dateofbirth" type="text" disabled="disabled" class="text" id="dateofbirth" title="Date of Birth" value="<?= $user['dateofbirth'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label class="label-text">Phone Number</label>
						<input name="phoneNumber" type="text" disabled="disabled" class="text" id="phoneNumber" title="Phone Number" value="<?= $user['phoneNumber'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="emailId" class="label-text">Email Id</label>
						<input name="emailId" type="text" disabled="disabled" class="text" id="emailId" title="emaiId" value="<?= $user['emailId'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="contactaddress" class="label-text">Address</label>
						<input name="contactaddress" type="text" disabled="disabled" class="text" id="contactaddress" title="Contact Address" value="<?= $user['contactaddress'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="city" class="label-text">City</label>
						<input name="city" type="text" disabled="disabled" class="text" id="city" title="city" value="<?= $user['city'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
					<div class="sub-container">
						<label for="pincode" class="label-text">Pin</label>
						<input name="pincode" type="text" disabled="disabled" class="text" id="pincode" title="pincode" value="<?= $user['pincode'] ?? '' ?>" size="60px" maxlength="80px">
					</div>
				</div>

			</div>

		</form>
	</div>

</body>

</html>