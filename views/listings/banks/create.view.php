<?php
Session::set('BACK', '/banks');
?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Create Bank Details</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?= loadPartial("header") ?>
  <div class="form-container" id="backgroundContainer">
    <form method="post" action="/banks/create">
      <div class="acctHolder">
        <h3>Bank Details
          <hr class="newAcctHR">
        </h3>
      </div>
      <div class="flex-container-create-account">
        <span class="asterisk_input"> </span>
        <input name="bankName" type="text" required="required" class="text accountOpening" id="bankName" placeholder="Bank Name" title="Bank Name" size="60px" maxlength="80px" value="" tabindex="1">
        <span class="asterisk_input"> </span>
        <input name="branchName" type="text" required="required" class="text accountOpening" id="branchName" placeholder="Branch Name" title="Branch Name" size="60px" maxlength="80px" value="" tabindex="2">
        <span class="asterisk_input"> </span>
        <input name="bankAbbr" type="text" required="required" class="text accountOpening" id="bankAbbr" placeholder="Bank Abbreviated Name" title="Bank Abbreviated Name Name" size="60px" maxlength="80px" tabindex="3">
        <span class="asterisk_input"> </span>
        <input name="pin" type="number" required="required" class="text accountOpening" id="pin" placeholder="Pin Code" title="pincode" size="60px" maxlength="80px" value="" tabindex="4">
        <span class="asterisk_input"> </span>
        <input name="city" type="text" required="required" class="text accountOpening" id="city" placeholder="City" title="City" size="60px" maxlength="80px" value="" tabindex="5">
      </div>
      <?= loadPartial("createButton") ?>
    </form>
  </div>
</body>

</html>