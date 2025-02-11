<?php

$acctCntr = new AccountsController();
$preferredNames = $acctCntr->search();

?>
<div class="searchModal hidden">
	<div>
		<h3 id="search-modal-header" class="search-modal-header">Edit Account</h3>
	</div>
	<h4>Select the account</h4>
	<?php if (count($preferredNames) !== 0) : ?>
		<form action="/accounts/search" method="post" id="acctSearch-form">
			<div>

				<select name="accountInfo" required="required" class="accountInfo" id="accountInfo">
					<?php foreach ($preferredNames as $preferredName): ?>
						<option value="<?= $preferredName["ACCOUNT_NBR"]  ?>"><?= $preferredName["PREFERRED_NAME"]  ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<input type="text" hidden value="" id="selected" name="selected">
		</form>

		<div class="acctSearch-buttons">
			<button type="button" id="cancel1" class="btn cancel" value="Cancel">Cancel</button>
			<button type="button" id="proceed" class="btn proceed" value="Edit Account">Proceed</button>
		</div>
	<?php else: ?>
		<div class="acctSearch-buttons">No records Found!!
			<button type="button" id="cancel1" class="btn cancel" value="Cancel">Cancel</button>
		</div>
	<?php endif; ?>
</div>