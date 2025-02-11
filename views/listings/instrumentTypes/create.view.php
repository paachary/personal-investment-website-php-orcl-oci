<?php
Session::set('BACK', '/instrumentTypes');

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Create Instrument Types</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?= loadPartial("header") ?>
  <div class="form-container" id="backgroundContainer">
    <form method="post" action="/instrumentTypes/create">
      <div class="acctHolder">
        <h3>Instrument Types
          <hr class="newAcctHR">
        </h3>
      </div>
      <div class="flex-container-create-account">
        <span class="asterisk_input"> </span>
        <input name="instrumentType" type="text" required="required" class="text accountOpening" id="instrumentType" placeholder="Instrument Type" title="Instrument Type" size="60px" maxlength="80px" value="" tabindex="1">
        <span class="asterisk_input"> </span>
        <input name="instrumentTypeDesc" type="text" required="required" class="text accountOpening" id="instrumentTypeDesc" placeholder="Instrument Type Description" title="Instrument Type Description" size="60px" maxlength="80px" value="" tabindex="2">
      </div>
      <?= loadPartial("createButton") ?>
    </form>
  </div>
</body>

</html>