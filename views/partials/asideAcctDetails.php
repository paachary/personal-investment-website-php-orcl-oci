<?php
$acctDetails = Session::get('acctDetails')  ?? "null";

?>
<aside class="aside">
	<div class="acct-details">
		<input type="text" class="text readonly-text" disabled="disabled" placeholder="accountNbr" title="accountNbr" size="60" maxlength="60" readonly="readonly" value='<?= $acctDetails["ACCOUNT_NBR"] ?>'>
		<input type="text" class="text readonly-text" disabled="disabled" placeholder="name" title="name" size="60" maxlength="60" readonly="readonly" value='<?= $acctDetails["FIRST_NAME"] . " " . $acctDetails["LAST_NAME"] ?>'>
		<input type="number" class="text readonly-text" disabled="disabled" placeholder="phone" title="phone" size="60" maxlength="60" readonly="readonly" value='<?= $acctDetails["PHONE_NBR"] ?>'>
		<input type="text" class="text readonly-text" disabled="disabled" placeholder="email" title="email" size="60" maxlength="60" readonly="readonly" value='<?= $acctDetails["EMAIL"] ?>'>
		<input type="text" class="text readonly-text" disabled="disabled" placeholder="bank" title="bank" size="100" maxlength="100" readonly="readonly" value='<?= $acctDetails["BANK_NAME"] . ", " . $acctDetails["BRANCH_NAME"] . ", " . $acctDetails["PIN"] ?>'>
		<input type="text" class="text readonly-text" disabled="disabled" placeholder="address" title="address" size="100" maxlength="100" readonly="readonly" value='<?= $acctDetails["ADDRESS"] . ", " . $acctDetails["PIN_CODE"] ?>'>
	</div>
</aside>