<?php
Session::set('msgType', 'delete');
$user = Session::get('user');
MessagesController::setDeleteMsg("This operation will delete all associated investments!<br><br>");
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Accounts Listing</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php loadPartial('header')  ?>
	<div class="tab-container backgroundContainer">
		<?php loadPartial("message"); ?>
		<h2>Accounts Listing</h2>
		<?php if ($user['userName'] !== 'sysadmin') : ?>
			<div class="newAccount"><a href="/accounts/create" title="Create New Account" id="createNewAcct">Create New Account</a></div>
			<div>
			<?php endif; ?>
			<table width="200" class="table">
				<tbody>
					<tr class="column-heading">
						<th scope="col">Account Number</th>
						<th scope="col">Preferred Name</th>
						<th scope="col">First Name</th>
						<th scope="col">Last Name</th>
						<th scope="col">Bank</th>
						<th scope="col">Branch</th>
						<th scope="col">City</th>
					</tr>
					<?php foreach ($accountsListings as $account) : ?>
						<tr>
							<td class="number">
								<div class="accountNumber"><a href="/savings/<?= $account['ACCOUNT_NBR'] ?>"
										title="Click to View Savings"><?= $account['ACCOUNT_NBR'] ?></a></div>

							</td>
							<td><?= $account['PREFERRED_NAME'] ?></td>
							<td><?= $account['FIRST_NAME'] ?></td>
							<td><?= $account['LAST_NAME'] ?></td>
							<td><?= $account['BANK_NAME'] ?></td>
							<td><?= $account['BRANCH_NAME'] ?></td>
							<td><?= $account['CITY'] ?></td>
							<td class="edit-child">
								<div class="btn-back"><a href="/accounts/edit/<?= $account['ACCOUNT_NBR'] ?>" title="Edit">
										<?php if (strtolower($user['userName']) !== 'sysadmin') : ?>
											Edit
										<?php else: ?>
											View
										<?php endif; ?>
									</a></div>
							</td>

							<?php if (strtolower($user['userName']) !== 'sysadmin') : ?>
								<td class="delete-child">
									<form action="/accounts/delete" method="post" id="deleteAccountForm" name="deleteAccountForm">
										<input type="text" hidden id="_method" name="_method" value="DELETE">
										<input type="text" hidden id="acctNbr" name="acctNbr" value="<?= $account['ACCOUNT_NBR'] ?>">
										<button type="button" id="deleteAccount_<?= $account['ACCOUNT_NBR'] ?>" name="deleteAccount" class="row-delete button"
											title="Delete Account">
											Delete
										</button>
									</form>
								</td>
							<?php else: ?>
								<td></td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			</div>
	</div>
	<?php loadPartial('modal'); ?>
	<script src="/scripts/deleteAccount.js"> </script>
</body>

</html>