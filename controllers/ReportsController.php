<?php

class ReportsController
{

  protected $db;
  protected $user;

  public function __construct()
  {
    $config = require basePath('config/_db.php');
    $this->db = new Database($config);
    $this->user = Session::get('user');
  }

  public function mnthlyDebitStmt()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $reportSumm = $this->db->getMonthlyDebitRpt();

    loadView('reports/mnthlyDebitStmt', [
      'reportSumm' => $reportSumm
    ]);
  }


  public function activeInvestmentsReport()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $reportSumm = $this->db->getActiveInvestmenttRpt();

    loadView('reports/activeInvestmentsReport', [
      'reportSumm' => $reportSumm
    ]);
  }
}
