<?php
$acctNbr =  Session::get('acctNbr');

$acctCntr = new AccountsController();

$acctDetails = $acctCntr->getAccountDetails($acctNbr);

$instruTypes = new InstrumentTypesController();

$instrumentTypes =  $instruTypes->getInstrumentTypes();
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Create New Investment</title>
	<link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?= loadPartial("header") ?>
	<h2 class="h2">Add Investment Details
		<hr>
	</h2>
	<div class="savingsDetails backgroundContainer">
		<?php Session::set('acctDetails', $acctDetails);
		loadPartial('asideAcctDetails') ?>
		<form action="/savings/new/create" method="post" class="savingsInfo">
			<input type="text" name="acctNbr" hidden value=<?= $acctNbr ?>>
			<input name="investmentDate" type="date" required="required" class="text" id="investmentDate" tabindex="1" title="Investment Date">
			<select name="investmentType" required="required" class="text" id="investmentType" tabindex="2" title="Investment Type">
				<?php foreach ($instrumentTypes as $instrumentType): ?>
					<option value="<?= $instrumentType['INSTRUMENT_TYPE'] ?>"><?= $instrumentType['INSTRUMENT_TYPE_DESC'] ?></option>
				<?php endforeach; ?>
			</select>
			<input name="instrumentId" type="text" required="required" class="text" id="instrumentId" placeholder="Instrument Id" tabindex="3" title="Instrument Id" size="50">
			<input name="instrumentName" type="text" required="required" class="text" id="instrumentName" placeholder="Instrument Name" tabindex="4" title="Instrument Name" size="50">
			<input name="instrumentAssocBank" type="text" required="required" class="text" id="instrumentAssocBank" placeholder="Instrument Assoc Bank" tabindex="5" title="Instrument Assoc Bank" size="50">
			<select name="instrumentType" required="required" class="text" id="instrumentType" tabindex="6" title="Instrument Type">
				<option value="" selected="selected">Select Investment Type</option>
				<option value="ONE_TIME">One Time Investment</option>
				<option value="SIP">Systematic Investment Plan</option>
				<option value="SWP">Systematic Withdrawal Plan</option>
			</select>
			<input name="investmentAmount" type="number" required="required" class="text" id="investmentAmount" placeholder="Investment Amount" tabindex="7" title="Investment Amount" size="50">

			<?php Session::set('BACK', '/savings/' . $acctNbr);
			loadPartial('createButton') ?>
		</form>
	</div>
</body>

</html>