<?php

class AccountsController
{
  protected $db;
  protected $user;

  public function __construct()
  {
    $config = require basePath('config/_db.php');
    $this->db = new Database($config);
    $this->user = Session::get('user');
  }

  public function index()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $accountsListings = $this->db->getAccountsDetails();

    loadView('listings/accounts/listing', [
      'accountsListings' => $accountsListings
    ]);
  }

  public function editView($params)
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $accountNbr = $params['acctNbr'] ?? '';

    $accountDetails = $this->db->getAccountDetails($accountNbr);

    loadView('listings/accounts/edit', [
      'accountDetails' => $accountDetails
    ]);
  }


  public function createView($params)
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    loadView('listings/accounts/create');
  }

  /**
   * Returns the bank details
   *
   * @return void
   */
  public function getBankDetails()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $bankDetails = $this->db->getBankDetails();
    return $bankDetails;
  }

  /**
   * Getting the preferred Names
   *
   * @return void
   */
  public function search()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $preferredNames = $this->db->getPreferredNames();
    return $preferredNames;
  }

  public function searchAccounts()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $acctNbr = $_POST["accountInfo"];

    Session::set('acctNbr', $acctNbr);

    $params["acctNbr"] = $acctNbr;

    $selected = $_POST["selected"];

    if ($selected === "editAcct") {
      $this->editView($params);
    } elseif ($selected === "newInvst") {
      loadView('listings/savings/create');
    } elseif ($selected === "viewInvst") {
      $savingsCntr = new SavingsController();
      $savingsCntr->index($params);
    }
  }

  public function update()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $allowedFields = ['_acctNbr', 'preferredName'];

    $newAccountDetails = array_intersect_key($_POST, array_flip($allowedFields));

    $newAccountDetails = array_map('sanitize', $newAccountDetails);

    $this->db->updateAccountDetails(
      intval($newAccountDetails["_acctNbr"]),
      $newAccountDetails["preferredName"],
    );

    Session::setFlashMessage('success_message', 'Account Updated Successfully!');

    redirect("/accounts");
  }

  public function create()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $allowedFields = [
      'userId',
      'bankDetails',
      'acctNumber',
      'preferredName',
      'userId'
    ];

    $newAccountDetails = array_intersect_key($_POST, array_flip($allowedFields));

    $newAccountDetails = array_map('sanitize', $newAccountDetails);

    $status = $this->db->insertAccountDetails(
      intval($newAccountDetails["userId"]),
      intval($newAccountDetails["bankDetails"]),
      intval($newAccountDetails["acctNumber"]),
      strtoupper($newAccountDetails["preferredName"])
    );

    if ($status === 0) {
      Session::setFlashMessage('success_message', 'Account Created Successfully!');
    } elseif ($status === 1) {
      Session::setFlashMessage('error_message', 'Account already exists!');
    }
    redirect("/accounts");
  }

  public function getAccountDetails($acctNbr)
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    return ($this->db->getAccountDetails($acctNbr)[0]);
  }

  public function delete()
  {
    $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

    $allowedFields = [
      'acctNbr',
    ];

    $newAccount = array_intersect_key($_POST, array_flip($allowedFields));

    $newAccount = array_map('sanitize', $newAccount);

    $this->db->deleteAccount($newAccount['acctNbr']);

    Session::setFlashMessage('success_message', 'Account deleted Successfully!');

    redirect("/accounts");
  }
}
