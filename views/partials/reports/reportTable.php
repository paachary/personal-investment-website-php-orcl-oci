        <?php

        ?>
        <table width="1200" border="1" summary="<?= $title ?>">
          <caption>
            <h3 class="reportHead">
              <?= $title ?>
            </h3>
          </caption>
          <tbody>
            <tr>
              <th scope="col">Bank Short Name</th>
              <th scope="col">Debit Account Number</th>
              <th scope="col">Account Holder Name</th>
              <th scope="col">Account Holder Preferred Name</th>
              <th scope="col">Total Invested Amount</th>
            </tr>
            <?php foreach ($reportSumm as $summ): ?>
              <tr>
                <td><?= $summ['BANK_SHORT_NAME'] ?></td>
                <td><?= $summ['DEBIT_ACCOUNT_NUMBER'] ?></td>
                <td><?= $summ['ACCOUNT_HOLDER_NAME'] ?></td>
                <td><?= $summ['ACCOUNT_HOLDER_PEFERRED_NAME'] ?></td>
                <td class="number"><?= formatAmount($summ['TOTAL_INVESTED_AMOUNT']) ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td colspan="4" class="textField">
                Cumulative Amount Invested
              </td>
              <?php if (count($reportSumm) > 0) : ?>
                <td>
                  <div class="textField amount"><?= formatAmount($summ['CUMULATIVE_SUM']) ?></div>
                </td>
              <?php else: ?>
                <td>
                  <div class="textField amount">0</div>
                </td>
              <?php endif; ?>
            </tr>

          </tbody>
        </table>