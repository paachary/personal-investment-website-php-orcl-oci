<?php
Session::set('msgType', 'close');
$user = Session::get('user');
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Edit Investment</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?= loadPartial("header") ?>
	<h2 class="h2">Edit Investment Details
		<hr>
	</h2>
	<div class="savingsDetails">
		<?php foreach ($investmentDetails as $investment) :	Session::set("acctDetails", $investment) ?>
			<?php loadPartial('asideAcctDetails');

			?>
			<form action="/savings/edit" method="post" class="savingsInfo backgroundContainer" id="savingsInfo">
				<input type=" text" name="acctNbr" hidden value="<?= $investment["ACCOUNT_NBR"] ?>">
				<input type=" text" name="investmentId" hidden value="<?= $investment["INVESTMENT_ID"] ?>">
				<input name="investmentId" type="text" disabled="disabled" required="required" class="text" id="instrumentId" title="Investment Id" readonly="readonly" placeholder="Instrument Id" value='<?= $investment["INSTRUMENT_ID"] ?>'>
				<input name="investmentDate" type="text" disabled="disabled" required="required" class="text" id="investmentDate" title="Investment Date" readonly="readonly" value='Opened On <?= $investment["INVESTMENT_DT"] ?>'>
				<input name="instrumentType" type="text" disabled="disabled" required="required" class="text" id="instrumentType" placeholder="Instrument Type" title="Instrument Type" size="50" readonly="readonly" value='<?= $investment["INSTRUMENT_TYPE"] ?>'>
				<input name="instrumentName" type="text" disabled="disabled" required="required" class="text" id="instrumentName" placeholder="Instrument Name" title="Instrument Name" size="50" readonly="readonly" value='<?= $investment["INSTRUMENT_NAME"] ?>'>
				<input name="investmentAmount" type="text" disabled="disabled" required="required" class="text" id="investmentAmount" placeholder="Investment Amount" title="Investment Amount" size="50" readonly="readonly" value='Invested <?= formatAmount($investment["INVESTMENT_AMT"]) ?>'>
				<input name="instrumentAssocBank" type="text" disabled="disabled" required="required" class="text" id="instrumentAssocBank" placeholder="Instrument Assoc Bank" title="Instrument Assoc Bank" size="50" readonly="readonly" value='<?= $investment["INSTRUMENT_ASSOC_BANK"] ?>'>
				<input name="investmentType" type="text" disabled="disabled" required="required" class="text" id="investmentType" placeholder="Investment Type" title="Investment Type" size="50" readonly="readonly" value='<?= $investment["INVESTMENT_TYPE"] ?>'>
				<?php if ($investment["ACTIVE_FLAG"] !== 'Y') : ?>
					<input name="instrumentClosedDt" type="text" disabled="disabled" required="required" class="text" id="instrumentClosedDt" placeholder="Instrument Closed Date" title="Instrument Closed Date" size="50" readonly="readonly" value='Closed on <?= $investment["INSTRUMENT_CLOSED_DT"] ?>'>
				<?php endif; ?>
				<div class="buttons">
					<div class="btn-back">
						<a href="<?= '/savings/' . $investment["ACCOUNT_NBR"] ?>">Back</a>
					</div>
					<?php if (($investment["ACTIVE_FLAG"] === 'Y')
						and (strtolower($user['userName']) !== 'sysadmin')
					) : ?>
						<button name="close" type="button" id="close" title="Close Investment" class="btn-close button">
							Close Investment
						</button>
					<?php endif; ?>
				</div>
			</form>
		<?php endforeach; ?>
	</div>
	<?= loadPartial('modal'); ?>
	<script src="/scripts/editInvestment.js"></script>
</body>

</html>