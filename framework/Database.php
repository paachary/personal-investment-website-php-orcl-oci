<?php

class Database
{

    public $conn;
    public $userId;

    /**
     * class Constructor
     *
     * @param [type] $config
     */
    public function __construct($config)
    {

        $connString = '//' . $config['host'] . ':' . $config['port'] . '/' . $config['dbServiceName'];

        $this->conn = oci_connect($config['username'], $config['password'], $connString);

        if (!$this->conn) {

            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }

    /**
     * Getting all the Account Listings.
     *
     * @return refcursor
     */
    public function getAccountsDetails()
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_all_accounts(); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }


    /**
     * Getting account details for an individual account number
     *
     * @param number $accountNbr
     * @return refcursor
     */
    public function getAccountDetails($accountNbr)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_account_details(:account_nbr); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':account_nbr', $accountNbr, -1, OCI_B_INT);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }

    public function getPreferredNames()
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_preferred_names; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }

    public function updateAccountDetails($accountNbr,  $preferredName)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin account_pkg.update_account_details(
                p_account_nbr => :account_nbr, 
                p_preferred_name => :preferred_name); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':account_nbr', $accountNbr, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':preferred_name', $preferredName, -1, SQLT_CHR);


        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);
    }

    public function insertAccountDetails(
        $userId,
        $bankId,
        $accountNbr,
        $preferredName
    ) {

        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin account_pkg.set_account_details(
                    p_user_id => :user_id, 
                    p_bank_id => :bank_id, 
                    p_account_nbr => :account_nbr, 
                    p_preferred_name => :preferred_name,
                    p_status => :status);  end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);
        $status = 0;

        oci_bind_by_name($stid, ':user_id', $userId, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':bank_id', $bankId, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':account_nbr', $accountNbr, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':preferred_name', $preferredName, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':status', $status, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $status;
    }


    public function deleteAccount($accountNbr)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin account_pkg.delete_account(
                    p_account_nbr => :account_nbr);  end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);
        $status = 0;

        oci_bind_by_name($stid, ':account_nbr', $accountNbr, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);
    }



    public function getBankDetails()
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_bank_details; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }

    public function getBankMasterDetails()
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_bank_master_details; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        oci_close($this->conn);

        return $res;
    }


    public function getBankDetail($bankId)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_bank_master_details(:bank_id); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':bank_id', $bankId, -1, OCI_B_INT);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        oci_close($this->conn);

        return $res;
    }

    public function updateBankDetails($bank_id, $bankAbbr, $pin, $city)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin account_pkg.update_bank_details(
                                        p_bank_id => :bank_id, 
                                        p_city => :city, 
                                        p_pin => :pin, 
                                        p_bank_abbr => :bank_abbr); end;');

        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':bank_id', $bank_id, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':city', $city, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':pin', $pin, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':bank_abbr', $bankAbbr, -1, SQLT_CHR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        oci_close($this->conn);
    }


    public function insertBankDetails($bankName, $branchName, $city, $pin, $bankAbbr)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :ret := account_pkg.insert_bank_details(p_bank_name => :bank_name, 
                                        p_branch_name =>:branch_name, 
                                        p_city => :city, 
                                        p_pin => :pin, 
                                        p_bank_abbr => :bank_abbr); end;');

        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);
        $status = 0;

        oci_bind_by_name($stid, ':bank_name', $bankName, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':branch_name', $branchName, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':city', $city, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':pin', $pin, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':bank_abbr', $bankAbbr, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':ret', $status, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        oci_close($this->conn);

        return $status;
    }

    /**
     * Get the list of Insrtument Types
     *
     * @return void
     */
    public function getInstrumentTypes()
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_instrument_types; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);


        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }


    public function getInstrumentType($instrumentTypeId)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_instrument_type(:instrument_type_id); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);


        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        oci_bind_by_name($stid, ':instrument_type_id', $instrumentTypeId, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }


    public function updateInstrumentType($instrumentTypeId, $instrumentTypeDesc)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin account_pkg.update_instrument_type(
                                        p_instrument_type_id => :instrument_type_id, 
                                        p_instrument_type_desc => :instrument_type_desc); end;');

        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':instrument_type_id', $instrumentTypeId, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':instrument_type_desc', $instrumentTypeDesc, -1, SQLT_CHR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        oci_close($this->conn);
    }


    public function insertInsrumentType($instrumentType, $instrumentTypeDesc)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :ret := account_pkg.insert_instrument_type(
                                        p_instrument_type => :instrument_type, 
                                        p_instrument_type_desc => :instrument_type_desc); end;');

        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);
        $status = 0;

        oci_bind_by_name($stid, ':instrument_type', $instrumentType, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':instrument_type_desc', $instrumentTypeDesc, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':ret', $status, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        oci_close($this->conn);

        return $status;
    }

    /**
     * Get the Savings for each Account function
     *
     * @param [type] $accountNbr
     * @return void
     */
    public function getSavingsByAccount($accountNbr)
    {

        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_savings_by_account(:account_nbr); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':account_nbr', $accountNbr, -1, OCI_B_INT);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }


    /**
     * Gets the instruments' details
     *
     * @param [number] $instrumentId
     * @return refcursor
     */
    public function getInvestmentDetails($investmentId)
    {

        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_investment_details(:investment_id); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':investment_id', $investmentId, -1, OCI_B_INT);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }


    public function closeInvestment($investmentId)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin account_pkg.close_investment(:investment_id); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':investment_id', $investmentId, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);
    }

    public function deleteInvestment($investmentId)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin account_pkg.delete_investment(:investment_id); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':investment_id', $investmentId, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);
    }

    public function setSavingsForAccount($investmentDetailsArray)
    {
        // Prepare the statement


        $stid = oci_parse($this->conn, 'begin 
        account_pkg.set_savings_for_account(
                    p_account_nbr => :acctNbr, 
                    p_instrument_type => :instrument_type,
                    p_instrument_id => :instrument_id,
                    p_instrument_name => :instrument_name, 
                    p_instrument_assoc_bank => :instrument_assoc_bank, 
                    p_investment_amount => :investment_amt,
                    p_investment_type => :type, 
                    p_investment_dt => :investment_dt); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $investmentDt = date('d-M-Y', strtotime($investmentDetailsArray['investmentDate']));
        $acctNbr = intval($investmentDetailsArray['acctNbr']);
        $amt = intval($investmentDetailsArray['investmentAmount']);

        oci_bind_by_name($stid, ':acctNbr', $acctNbr, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':instrument_type', $investmentDetailsArray['investmentType']);
        oci_bind_by_name($stid, ':instrument_id', $investmentDetailsArray['instrumentId']);
        oci_bind_by_name($stid, ':instrument_name', $investmentDetailsArray['instrumentName']);
        oci_bind_by_name($stid, ':instrument_assoc_bank', $investmentDetailsArray['instrumentAssocBank']);
        oci_bind_by_name($stid, ':investment_amt', $amt, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':type', $investmentDetailsArray['instrumentType']);
        oci_bind_by_name($stid, ':investment_dt', $investmentDt);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        // oci_close($this->conn);
    }

    public function getUserDetails($userName)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_user_details(:user_name); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':user_name', $userName, -1, SQLT_CHR);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }

    public function updateUserDetails(
        $userId,
        $phoneNumber,
        $emailId,
        $pincode,
        $contactaddress,
        $city
    ) {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :ret := account_pkg.update_user_details (
                                        p_user_id => :user_id,
                                        p_phone_nbr => :phone_nbr,
                                        p_email   => :email,
                                        p_pin_code => :pin_code,
                                        p_city    => :city,
                                        p_address => :address
                                    ); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);
        $status = 0;

        oci_bind_by_name($stid, ':ret', $status, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':user_id', $userId, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':phone_nbr', $phoneNumber, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':email', $emailId, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':pin_code', $pincode, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':city', $contactaddress, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':address', $city, -1, SQLT_CHR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        oci_close($this->conn);

        return $status;
    }

    public function resetPassword($userId, $password, $newPassword)
    {
        // Prepare the statement
        $stid = oci_parse($this->conn, 'begin :ret := account_pkg.reset_password (
                            p_user_id => :user_id ,
                            p_password => :password ,
                            p_new_password => :newpassowrd ); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);
        $status = 0;

        oci_bind_by_name($stid, ':ret', $status, -1, OCI_B_INT);
        oci_bind_by_name(
            $stid,
            ':user_id',
            $userId,
            -1,
            OCI_B_INT,
        );
        oci_bind_by_name($stid, ':password', $password, -1, SQLT_CHR);
        oci_bind_by_name($stid, ':newpassowrd', $newPassword, -1, SQLT_CHR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $status;
    }

    public function registerNewUser($user)
    {
        // Prepare the statement
        $stid = oci_parse(
            $this->conn,
            'begin :ret :=  
            account_pkg.register_new_user(
            p_user_name => :user_name,
            p_password => :password,
            p_first_name => :first_name,
            p_last_name => :last_name,
            p_dob => :dob,
            p_gender => :gender,
            p_email => :email,
            p_phone_nbr => :phone_nbr,
            p_city => :city,
            p_address => :address,
            p_pin_code => :pin_code,
            p_user_id  => :user_id); 
            end;'
        );
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $dob = date('d-M-Y', strtotime($user['dateofbirth']));
        $phoneNbr = intval($user['phoneNumber']);
        $pincode = intval($user['pincode']);

        $retVal = 0;

        oci_bind_by_name(
            $stid,
            ':ret',
            $retVal,
            -1,
            OCI_B_INT
        );
        oci_bind_by_name($stid, ':user_name', $user['userName']);
        oci_bind_by_name($stid, ':password', $user['password']);
        oci_bind_by_name($stid, ':first_name', $user['firstName']);
        oci_bind_by_name($stid, ':last_name', $user['lastName']);
        oci_bind_by_name($stid, ':dob', $dob);
        oci_bind_by_name($stid, ':gender', $user['gender']);
        oci_bind_by_name($stid, ':email', $user['emailId']);
        oci_bind_by_name($stid, ':phone_nbr', $phoneNbr, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':city', $user['city']);
        oci_bind_by_name($stid, ':address', $user['contactaddress']);
        oci_bind_by_name($stid, ':pin_code', $pincode, -1, OCI_B_INT);
        oci_bind_by_name($stid, ':user_id', $this->userId, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        oci_free_statement($stid);

        // oci_close($this->conn);

        return $retVal;
    }

    public function setApplicationContext($userId, $userName)
    {
        $stid = oci_parse($this->conn, 'begin 
        ctx_pkg.set_session_id(:session_id); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_bind_by_name($stid, ':session_id', $userId, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($this->conn, 'begin 
        ctx_pkg.set_ctx ( p_sec_level_attr => :attr, p_sec_level_val => :val ) ; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        $value = 'user_name';

        oci_bind_by_name($stid, ':attr', $value);
        oci_bind_by_name($stid, ':val', $userName);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }


        $stid = oci_parse($this->conn, 'begin 
        ctx_pkg.set_ctx ( p_sec_level_attr => :attr, p_sec_level_val => :val ) ; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $value = 'user_id';

        oci_bind_by_name($stid, ':attr', $value);
        oci_bind_by_name($stid, ':val', $userId);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }


        oci_free_statement($stid);

        // oci_close($this->conn);
    }

    public function clearApplicationContext($userId)
    {
        $stid = oci_parse($this->conn, 'begin 
        ctx_pkg.clear_session(:session_id); end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_bind_by_name($stid, ':session_id', $userId, -1, OCI_B_INT);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($this->conn, 'begin 
        ctx_pkg.clear_context  ; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_free_statement($stid);

        oci_close($this->conn);
    }


    public function getActiveInvestmenttRpt()
    {
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_active_investment_rpt; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }


    public function getMonthlyDebitRpt()
    {
        $stid = oci_parse($this->conn, 'begin :cursor := account_pkg.get_monthly_debit_rpt; end;');
        if (!$stid) {

            $e = oci_error($this->conn);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $p_cursor = oci_new_cursor($this->conn);

        oci_bind_by_name($stid, ':cursor', $p_cursor, -1, OCI_B_CURSOR);

        // Perform the logic of the query
        $r = oci_execute($stid);

        if (!$r) {
            $e = oci_error($stid);
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        oci_execute($p_cursor);

        oci_fetch_all($p_cursor, $res, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

        oci_free_statement($stid);

        oci_free_statement($p_cursor);

        // oci_close($this->conn);

        return $res;
    }
}
