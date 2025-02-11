<?php
$user = Session::get('user');
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Edit Account</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?= loadPartial('header') ?>
	<div class="form-container backgroundContainer">
		<?php loadPartial("message"); ?>
		<form method="post" action="/accounts/edit">
			<?= loadPartial('accountHolderHeader') ?>
			<?php foreach ($accountDetails as $accountDtls) : ?>

				<div class="flex-container">
					<input name="firstName" type="text" disabled="disabled" class="text read-only-text accountOpening" id="firstName" placeholder="First Name" title="First Name" size="80px" maxlength="80px" value='<?= $accountDtls["FIRST_NAME"] . " " . $accountDtls["LAST_NAME"] ?>' readonly="readonly">
					<span class="asterisk_input"> </span>
					<input name="preferredName" type="text" class="text read-only-text accountOpening" id="preferredName" tabindex="1" placeholder="Preferred Name" title="Preferred Name" size="40px" maxlength="80px" value='<?= $accountDtls["PREFERRED_NAME"] ?>'>


				</div>

				<div class="flex-container">
					<input name="phoneNumber" type="number" disabled="disabled" required="required" class="text read-only-text accountOpening" id="phoneNumber" placeholder="Phone Number" title="phoneNumber" size="60px" maxlength="80px" value='<?= $accountDtls["PHONE_NBR"] ?>'>
					<input name="emailId" type="email" disabled="disabled" required="required" class="text read-only-text accountOpening" id="emaiId" placeholder="Email Id" title="emaiId" size="60px" maxlength="80px" value='<?= $accountDtls["EMAIL"] ?>'>
				</div>

				<div class="flex-container">
					<input name="acctNumber" type="text" disabled="disabled" class="text read-only-text accountOpening" id="acctNumber" placeholder="Account Number" title="acctNumber" size="60px" maxlength="80px" readonly="readonly" value='<?= $accountDtls["ACCOUNT_NBR"] ?>'>
					<input name="bankName" type="text" disabled="disabled" class="text read-only-text accountOpening" id="bankName" placeholder="Bank Name" title="bankName" size="60px" maxlength="80px" readonly="readonly" value='<?= $accountDtls["BANK_NAME"] . ", " . $accountDtls["BRANCH_NAME"]  . ", " . $accountDtls["CITY"] . ", " . $accountDtls["PIN"] ?>'>
				</div>

				<div class="flex-container">
					<input type="text" name="contactaddress" disabled="disabled" size=90px required="required" class="text read-only-text accountOpening" id="contactaddress" placeholder="Contact Address" title="contactaddress" value='<?= $accountDtls["ADDRESS"] ?>'>
					<input type="number" name="pincode" disabled="disabled" size=20px required="required" class="text read-only-text" id="pincode" placeholder="Pin Code" title="pincode" value='<?= $accountDtls["PIN_CODE"] ?>'>
				</div>
				<input type="hidden" name="_acctNbr" value='<?= $accountDtls["ACCOUNT_NBR"] ?>'>
				<div class="buttons">
					<div class="btn-back">
						<a tabindex="2" href="/accounts">Back</a>
					</div>
					<?php if (strtolower($user['userName']) !== 'sysadmin') : ?>
						<button name="submit" tabindex="3" type="submit" id="submit" title="submit" value="update" class="btn-submit button">
							Submit
						</button>
						<button name="reset" tabindex="4" type="reset" id="reset" title="reset" class="btn-reset button">
							Reset
						</button>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</form>
	</div>
</body>

</html>