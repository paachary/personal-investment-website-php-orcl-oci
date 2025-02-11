<?php
Session::set('msgType', 'delete');
$user = Session::get('user');
?>


<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>My Investments</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?= loadPartial("header") ?>
	<div class="tab-container backgroundContainer">
		<?php loadPartial("message"); ?>
		<div class="header">
			<div class="btn-back"><a href="/accounts">Back</a></div>
			<h2>My Investments</h2>
			<div></div>
		</div>
		<hr>
		<div class="acctdetails">
			<h4>Account Details
				<hr>
			</h4>
			<?php for ($i = 0; $i < 1; $i++) : ?>
				<div class="flex-container">
					<input name="name" type="text" disabled="disabled" required="required"
						class="text acctSavingsDtls read-only-text" id="name" placeholder="Name" title="Name" size="70px"
						maxlength="80px" readonly="readonly"
						value='<?= $savingsListing[$i]["FIRST_NAME"] . " " . $savingsListing[$i]["LAST_NAME"] ?>'>
					<input name="acctNumber" type="text" disabled="disabled" required="required"
						class="text acctSavingsDtls read-only-text" id="acctNumber" placeholder="Account Number"
						title="acctNumber" readonly="readonly"
						value='<?= $savingsListing[$i]["ACCOUNT_NBR"] ?>'>
				</div>
				<div class="flex-container">
					<input name="phoneNumber" type="number" disabled="disabled" class="text acctSavingsDtls read-only-text"
						id="phoneNumber" placeholder="Phone Number" title="phoneNumber" readonly="readonly"
						value='<?= $savingsListing[$i]["PHONE_NBR"] ?>'">
					<input name=" emailId" type="email" disabled="disabled" class="text acctSavingsDtls read-only-text" id="emaiId"
						placeholder="Email Id" title="emaiId" readonly="readonly"
						value='<?= $savingsListing[$i]["EMAIL"] ?>'">
				</div>
				<div class=" flex-container">
					<input name="bankDetails" type="text" disabled="disabled" required="required"
						class="text acctSavingsDtls read-only-text" id="bankDetails" placeholder="Bank Details"
						title="Bank Details" size="100px" maxlength="100px" readonly="readonly"
						value='<?= $savingsListing[$i]["BANK_NAME"] . ", " . $savingsListing[$i]["BRANCH_NAME"]  . ", " . $savingsListing[$i]["CITY"] . ", " . $savingsListing[$i]["PIN"] ?>'>
				</div>
				<div class="flex-container">
					<input type="text" name="contactaddress" size=90px disabled="disabled" readonly="readonly"
						required="required" class="text acctSavingsDtls read-only-text" id="contactaddress"
						placeholder="Contact Address" title="contactaddress"
						value='<?= $savingsListing[$i]["ADDRESS"] ?>'>
					<input type="number" name="pincode" size=20px required="required" disabled="disabled"
						readonly="readonly" class="text acctSavingsDtls read-only-text" id="pincode" placeholder="Pin Code"
						tabindex="5" title="pincode"
						value='<?= $savingsListing[$i]["PIN_CODE"] ?>'>
				</div>
				<?php Session::set('acctNbr', $savingsListing[$i]["ACCOUNT_NBR"]); ?>
			<?php endfor; ?>
		</div>
		<hr>
		<div>
			<?php if ($user['userName'] !== 'sysadmin') : ?>
				<div class="newSavings newAccount">
					<a href="/savings/new/create" tabindex="1" title="New Investment">
						Add New Investment</a>
				</div>
			<?php endif; ?>
			<table width="200" class="table">
				<tbody>
					<tr class="column-heading">
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Instrument Type</th>
						<th scope="col">Date</th>
						<th scope="col">Investment Type</th>
						<th scope="col">Amount</th>
						<th scope="col">Associated Bank</th>
						<th scope="col">Active Indicator</th>
					</tr>
					<?php foreach ($savingsListing as $saving): ?>
						<?php if (!is_null($saving['INSTRUMENT_ID'])) : ?>
							<tr>
								<td class="number"><?= $saving['INSTRUMENT_ID'] ?>
								</td>
								<td><?= $saving['INSTRUMENT_NAME'] ?>
								</td>
								<td><?= $saving['INSTRUMENT_TYPE'] ?>
								</td>
								<td><?= $saving['INVESTMENT_DT'] ?>
								</td>
								<td><?= $saving['INVESTMENT_TYPE'] ?>
								</td>
								<td class="number"> <?= formatAmount($saving["INVESTMENT_AMT"]) ?>
								</td>
								<td><?= $saving['INSTRUMENT_ASSOC_BANK'] ?>
								</td>
								<td><?= $saving['ACTIVE_FLAG'] ?>
								</td>
								<td class="edit-child">
									<div class="btn-back"><a
											href="/savings/edit/<?= $saving['INVESTMENT_ID'] ?>">
											<?php if (strtolower($user['userName']) !== 'sysadmin') : ?>
												Edit
											<?php else: ?>
												View
											<?php endif; ?>
										</a>
									</div>
								</td>
								<?php if (strtolower($user['userName']) !== 'sysadmin') : ?>
									<td class="delete-child">
										<form id="formDelete" action="/savings/edit" method="post">
											<input type="text" name="investmentId" id="investmentId"
												value="<?= $saving['INVESTMENT_ID'] ?>"
												hidden>
											<input type="hidden" name="_method" value="DELETE">
											<input type="hidden" name="acctNbr"
												value="<?= Session::get('acctNbr'); ?>">
											<button type="button" class="row-delete button" value="delete" id="deleteInvestment_<?= $saving['INVESTMENT_ID'] ?>"
												name="deleteInvestment">
												Delete
											</button>
										</form>
									</td>
								<?php else: ?>
									<td></td>
								<?php endif; ?>
							</tr>
						<?php else : ?>
							<tr>
								<td colspan="100%">
									<div class="textField">No Data Found</div>
								</td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
					<tr>
						<td colspan="5" class="textField">
							Cumulative Amount Invested
						</td>
						<td>
							<div class="textField" id="amount"> ₹0</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<?php loadPartial('modal'); ?>
	<script src="/scripts/deleteInvestment.js"></script>
</body>

</html>