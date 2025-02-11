<?php

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Edit Instrument Types</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?= loadPartial('header') ?>
  <div class="form-container backgroundContainer">
    <?php loadPartial("message"); ?>
    <form method="post" action="/instrumentTypes/edit">
      <div class="acctHolder">
        <h3>Instrument Types
          <hr class="newAcctHR">
        </h3>
      </div>
      <?php foreach ($instrumentTypeListings as $instrumentType) : ?>

        <div class="flex-container">
          <input name="type" type="text" disabled="disabled" class="text read-only-text accountOpening" id="bank" placeholder="Type" title="TYpe" size="80px" maxlength="80px" value='<?= $instrumentType["INSTRUMENT_TYPE"]  ?>' readonly="readonly">
          <span class="asterisk_input"> </span>
          <input name="desc" type="text" class="text read-only-text accountOpening" id="bankAbbr" tabindex="1" placeholder="Instrument Type Description" title="Instrument Type Description" size="40px" maxlength="80px" value='<?= $instrumentType["INSTRUMENT_TYPE_DESC"] ?>'>
        </div>
        <input type="hidden" name="_instrumentTypeId" value='<?= $instrumentType["INSTRUMENT_TYPE_ID"] ?>'>
      <?php endforeach; ?>
      <div class="buttons">
        <div class="btn-back">
          <a tabindex="4" href="/instrumentTypes">Back</a>
        </div>

        <button name="submit" tabindex="5" type="submit" id="submit" title="submit" value="update" class="btn-submit button">
          Submit
        </button>
        <button name="reset" tabindex="6" type="reset" id="reset" title="reset" class="btn-reset button">
          Reset
        </button>
      </div>

    </form>
  </div>
</body>

</html>