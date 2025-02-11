<?php

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Edit Bank Details</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?= loadPartial('header') ?>
  <div class="form-container backgroundContainer">
    <?php loadPartial("message"); ?>
    <form method="post" action="/banks/edit">
      <div class="acctHolder">
        <h3>Bank Details
          <hr class="newAcctHR">
        </h3>
      </div>
      <?php foreach ($banksListings as $bank) : ?>

        <div class="flex-container">
          <input name="bank" type="text" disabled="disabled" class="text read-only-text accountOpening" id="bank" placeholder="Bank" title="Bank" size="80px" maxlength="80px" value='<?= $bank["BANK_NAME"] . " ," . $bank["BRANCH_NAME"] ?>' readonly="readonly">
          <span class="asterisk_input"> </span>
          <input name="bankAbbr" type="text" class="text read-only-text accountOpening" id="bankAbbr" tabindex="1" placeholder="Bank Abbreviation" title="Bank Abbreviation" size="40px" maxlength="80px" value='<?= $bank["BANK_ABBR"] ?>'>
        </div>
        <div class="flex-container">
          <span class="asterisk_input"> </span>
          <input type="text" name="city" size=90px required="required" class="text read-only-text accountOpening" tabindex="2" id="city" placeholder="City" title="city" value='<?= $bank["CITY"] ?>'>
          <span class="asterisk_input"> </span>
          <input type="number" name="pin" size=20px required="required" class="text read-only-text" id="pin" tabindex="3" placeholder="Pin Code" title="pin" value='<?= $bank["PIN"] ?>'>
        </div>
        <input type="hidden" name="_bankId" value='<?= $bank["BANK_ID"] ?>'>
        <div class="buttons">
          <div class="btn-back">
            <a tabindex="4" href="/banks">Back</a>
          </div>
          <button name="submit" tabindex="5" type="submit" id="submit" title="submit" value="update" class="btn-submit button">
            Submit
          </button>
          <button name="reset" tabindex="6" type="reset" id="reset" title="reset" class="btn-reset button">
            Reset
          </button>
        </div>
      <?php endforeach; ?>
    </form>
  </div>
</body>

</html>