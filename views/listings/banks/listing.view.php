<?php

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Bank Details</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?php loadPartial('header')  ?>
  <div class="tab-container backgroundContainer">
    <?php loadPartial("message"); ?>
    <h2>Bank Details</h2>
      <div class="newAccount"><a href="/banks/create" title="Create New Bank Details" id="createNewBank">Create New Bank Details</a></div>
      <div>
      <table width="200" class="table">
        <tbody>
          <tr class="column-heading">
            <th scope="col">Abbreviated Name</th>
            <th scope="col">Bank Name</th>
            <th scope="col">Branch Name</th>
            <th scope="col">City</th>
            <th scope="col">Pin Code</th>
          </tr>
          <?php foreach ($banksListings as $bank) : ?>
            <tr>
              <td>
                <div><a href="/banks/edit/<?= $bank['BANK_ID'] ?>"
                    title="Click to View Bank Details"><?= $bank['BANK_ABBR'] ?></a></div>

              </td>
              <td><?= $bank['BANK_NAME'] ?></td>
              <td><?= $bank['BRANCH_NAME'] ?></td>
              <td><?= $bank['CITY'] ?></td>
              <td><?= $bank['PIN'] ?></td>
              <td></td>
              <td></td>
              </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      </div>
  </div>
</body>

</html>