<?php
class SavingsController
{
    protected $db;
    protected $user;

    public function __construct()
    {

        $config = require basePath('config/_db.php');

        $this->db = new Database($config);

        $this->user = Session::get('user');
    }

    public function index($params)
    {
        $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

        $accountNbr = $params['acctNbr'] ?? '';

        $savingsListing = $this->db->getSavingsByAccount($accountNbr);

        loadView('listings/savings/listing', [
            'savingsListing' => $savingsListing
        ]);
    }

    public function editView($params)
    {
        $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

        $investmentId = $params['investmentId'] ?? '';

        $investmentDetails = $this->db->getInvestmentDetails($investmentId);

        loadView('listings/savings/edit', [
            'investmentDetails' => $investmentDetails
        ]);
    }

    public function createView($params)
    {
        $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);
        loadView('listings/savings/create');
    }

    public function update()
    {
        $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

        $allowedFields = ['acctNbr', 'investmentId'];

        $newAccountDetails = array_intersect_key($_POST, array_flip($allowedFields));

        $newAccountDetails = array_map('sanitize', $newAccountDetails);

        $this->db->closeInvestment(
            intval($newAccountDetails["investmentId"])
        );

        Session::setFlashMessage('success_message', 'Investment Closed Successfully!');

        redirect("/savings/" . $newAccountDetails["acctNbr"]);
    }

    public function delete()
    {
        $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

        $allowedFields = ['acctNbr', 'investmentId'];

        $newAccountDetails = array_intersect_key($_POST, array_flip($allowedFields));

        $newAccountDetails = array_map('sanitize', $newAccountDetails);

        $this->db->deleteInvestment(
            intval($newAccountDetails["investmentId"])
        );

        Session::setFlashMessage('success_message', 'Investment Deleted Successfully!');

        redirect("/savings/" . $newAccountDetails["acctNbr"]);
    }

    public function create()
    {
        $this->db->setApplicationContext($this->user['userId'], $this->user['userName']);

        $allowedFields = [
            'acctNbr',
            'investmentDate',
            'investmentType',
            'instrumentId',
            'instrumentName',
            'instrumentAssocBank',
            'instrumentType',
            'investmentAmount'
        ];

        $newSavingsDetails = array_intersect_key($_POST, array_flip($allowedFields));

        $newSavingsDetails = array_map('sanitize', $newSavingsDetails);

        $this->db->setSavingsForAccount(
            $newSavingsDetails
        );

        Session::setFlashMessage('success_message', 'Investment Created Successfully!');

        redirect("/savings/" . $newSavingsDetails["acctNbr"]);
    }
}
