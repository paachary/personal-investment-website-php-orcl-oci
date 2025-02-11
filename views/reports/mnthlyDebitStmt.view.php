<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reports</title>
    <link href="/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php loadPartial('header')  ?>
    <div class="tab-container backgroundContainer">
        <div class="header">
            <div class="btn-back"><a href="/">Back</a></div>
            <h2>Reports</h2>
            <div></div>
        </div>
        <?= loadPartial("reports/reportTable", [
            'reportSumm' => $reportSumm,
            'title' => 'Monthly Debit Report'
        ]); ?>
    </div>
</body>