<?php

?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Instrument Types</title>
  <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?php loadPartial('header')  ?>
  <div class="tab-container backgroundContainer">
    <?php loadPartial("message"); ?>
    <h2>Instrument Types</h2>
    <div class="newAccount"><a href="/instrumentTypes/create" title="Create New Instrument Types" id="createNewBank">Create New Instrument Types</a></div>
    <div>
      <table width="200" class="table">
        <tbody>
          <tr class="column-heading">
            <th scope="col">Instrument Type Code</th>
            <th scope="col">Instrument Type</th>
          </tr>
          <?php foreach ($instrumentTypeListings as $instrumentType) : ?>
            <tr>
              <td>
                <div><a href="/instrumentTypes/edit/<?= $instrumentType['INSTRUMENT_TYPE_ID'] ?>"
                    title="Click to View Instrument Type Details"><?= $instrumentType['INSTRUMENT_TYPE'] ?></a></div>

              </td>
              <td><?= $instrumentType['INSTRUMENT_TYPE_DESC'] ?></td>
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