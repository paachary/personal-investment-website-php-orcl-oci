<?php

class BanksController
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
    $banksListings = $this->db->getBankMasterDetails();

    loadView('listings/banks/listing', [
      'banksListings' => $banksListings
    ]);
  }

  public function edit($params)
  {
    $bankId = $params['bankId'] ?? '';

    $banksListings = $this->db->getBankDetail($bankId);

    loadView('listings/banks/edit', [
      'banksListings' => $banksListings
    ]);
  }

  public function create($params)
  {
    loadView('listings/banks/create');
  }

  public function update()
  {

    $allowedFields = ['_bankId', 'bankAbbr', 'city', 'pin'];

    $newBankFields = array_intersect_key($_POST, array_flip($allowedFields));

    $newBankFields = array_map('sanitize', $newBankFields);


    $this->db->updateBankDetails(
      intval($newBankFields["_bankId"]),
      strtoupper($newBankFields["bankAbbr"]),
      intval($newBankFields["pin"]),
      strtoupper(
        $newBankFields["city"]
      )
    );

    Session::setFlashMessage('success_message', 'Record Updated Successfully!');

    redirect("/banks");
  }

  public function store()
  {
    $allowedFields = [
      'bankName',
      'branchName',
      'bankAbbr',
      'pin',
      'city'
    ];

    $newBankDetails = array_intersect_key($_POST, array_flip($allowedFields));

    $newAccountDetails = array_map('sanitize', $newBankDetails);

    $status = $this->db->insertBankDetails(
      bankName: strtoupper($newAccountDetails['bankName']),
      branchName: strtoupper($newAccountDetails['branchName']),
      bankAbbr: strtoupper($newAccountDetails['bankAbbr']),
      pin: $newAccountDetails['pin'],
      city: strtoupper($newAccountDetails['city'])
    );

    if ($status === 0) {
      Session::setFlashMessage('success_message', 'Record Created Successfully!');
    } elseif ($status === 1) {
      Session::setFlashMessage('error_message', 'Account already exists!');
    }
    redirect("/banks");
  }
}
