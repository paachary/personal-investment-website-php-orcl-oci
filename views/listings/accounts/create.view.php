<?php
Session::set('BACK', '/accounts');
$user = Session::get('user');

$accntsCntr = new AccountsController();
$bankDetails = $accntsCntr->getBankDetails();
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Create Account</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?= loadPartial("header") ?>
	<div class="form-container" id="backgroundContainer">
		<form method="post" action="/accounts/create">
			<?= loadPartial("accountHolderHeader") ?>
			<div class="flex-container-create-account">
				<input name="firstName" type="text" disabled required="required" class="text accountOpening" id="firstName" placeholder="First Name" title="firstName" size="60px" maxlength="80px" value="<?= $user['firstName'] ?>">
				<input name="lastName" type="text" required="required" class="text accountOpening" id="lastName" placeholder="Last Name" title="lastName" size="60px" maxlength="80px" disabled value="<?= $user['lastName'] ?>">
				<span class="asterisk_input"> </span>
				<input name=" preferredName" type="text" required="required" class="text accountOpening" id="preferredName" placeholder="Preferred Name" tabindex="1" title="Preferred Name" size="60px" maxlength="80px">
				<input name="phoneNumber" type="number" required="required" class="text accountOpening" id="phoneNumber" placeholder="Phone Number" title="phoneNumber" size="60px" maxlength="80px" disabled value="<?= $user['phoneNumber'] ?>">
				<input name="emailId" type="email" required="required" class="text accountOpening" id="emaiId" placeholder="Email Id" title="emaiId" size="60px" maxlength="80px" disabled value="<?= $user['emailId'] ?>">
				<span class="asterisk_input"> </span>
				<select tabindex="2" name="bankDetails" required="required" class="text selectBankDetails" id="bankDetails" title="Bank Details" placeholder="Bank Details">
					<?php foreach ($bankDetails as $bankDetail): ?>
						<option value="<?= $bankDetail['NAME'] ?>"><?= $bankDetail['VALUE'] ?></option>
					<?php endforeach; ?>
				</select>
				<span class="asterisk_input"> </span>
				<input name="acctNumber" type="text" required="required" class="text accountOpening" id="acctNumber" placeholder="Account Number" tabindex="3" title="acctNumber" size="60px" maxlength="80px">
				<input name="contactaddress" type="text" maxlength="2000px" required="required" class="text accountOpening" id="contactaddress" placeholder="Contact Address" title="contactaddress" disabled value="<?= $user['contactaddress'] ?>">
				<input name="pincode" type="number" required="required" class="text accountOpening" id="pincode" placeholder="Pin Code" title="pincode" size="60px" maxlength="80px" disabled value="<?= $user['pincode'] ?>">
				<input name="city" type="text" required="required" class="text accountOpening" id="city" placeholder="Pin Code" title="city" size="60px" maxlength="80px" disabled value="<?= $user['city'] ?>">
				<input name="userId" hidden value="<?= $user['userId'] ?>">
			</div>
			<?= loadPartial("createButton") ?>
		</form>
	</div>
</body>

</html>