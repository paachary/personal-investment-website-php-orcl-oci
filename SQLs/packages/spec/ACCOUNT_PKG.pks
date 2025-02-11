create or replace package "ACCOUNT_PKG" as
   function get_all_accounts return sys_refcursor;

   function get_account_details (
      p_account_nbr in account_holder.account_nbr%type
   ) return sys_refcursor;

   function get_preferred_names return sys_refcursor;

   procedure set_account_details (
      p_user_id        in account_holder.user_id%type default 0,
      p_bank_id        in account_holder.bank_id%type,
      p_account_nbr    in account_holder.account_nbr%type,
      p_preferred_name in account_holder.preferred_name%type,
      p_status         out number
   );

   procedure update_account_details (
      p_account_nbr    in account_holder.account_nbr%type,
      p_preferred_name in account_holder.preferred_name%type
   );

   procedure delete_account (
      p_account_nbr in account_holder.account_nbr%type
   );

   function get_savings_by_account (
      p_account_nbr in account_holder.account_nbr%type
   ) return sys_refcursor;

   function get_investment_details (
      p_investment_id account_investment_details_vw.investment_id%type
   ) return sys_refcursor;

   procedure close_investment (
      p_investment_id account_investment_details_vw.investment_id%type
   );

   procedure delete_investment (
      p_investment_id account_investment_details_vw.investment_id%type
   );

   procedure set_savings_for_account (
      p_account_nbr           in investment_details.account_nbr%type,
      p_instrument_type       in investment_details.instrument_type%type,
      p_instrument_id         in investment_details.instrument_id%type,
      p_instrument_name       in investment_details.instrument_name%type,
      p_instrument_assoc_bank in investment_details.instrument_assoc_bank%type,
      p_investment_amount     in investment_details.investment_amt%type,
      p_investment_type       in investment_details.investment_type%type,
      p_investment_dt         in investment_details.investment_dt%type
   );


   function get_bank_details return sys_refcursor;

   function get_bank_master_details return sys_refcursor;

   function get_bank_master_details (
      p_bank_id in bank_master.bank_id%type
   ) return sys_refcursor;

   procedure update_bank_details (
      p_bank_id   in bank_master.bank_id%type,
      p_bank_abbr in bank_master.bank_abbr%type,
      p_pin       in bank_master.pin%type,
      p_city      in bank_master.city%type
   );

   function insert_bank_details (
      p_bank_name   bank_master.bank_name%type,
      p_branch_name bank_master.branch_name%type,
      p_city        bank_master.city%type,
      p_pin         bank_master.pin%type,
      p_bank_abbr   bank_master.bank_abbr%type
   ) return number;


   function get_instrument_types return sys_refcursor;

   function get_instrument_type (
      p_instrument_type_id in instrument_type.instrument_type_id%type
   ) return sys_refcursor;

   procedure update_instrument_type (
      p_instrument_type_id   in instrument_type.instrument_type_id%type,
      p_instrument_type_desc in instrument_type.instrument_type_desc%type
   );

   function insert_instrument_type (
      p_instrument_type      in instrument_type.instrument_type%type,
      p_instrument_type_desc in instrument_type.instrument_type_desc%type
   ) return number;


   function get_active_investment_rpt return sys_refcursor;

   function get_monthly_debit_rpt return sys_refcursor;

   function get_user_details (
      p_user_name in customer.user_name%type
   ) return sys_refcursor;

   function register_new_user (
      p_user_name  in customer.user_name%type,
      p_password   in customer.password%type,
      p_first_name in customer.first_name%type,
      p_last_name  in customer.last_name%type,
      p_gender     in customer.gender%type,
      p_dob        in customer.dob%type,
      p_email      in customer.email%type,
      p_phone_nbr  in customer.phone_nbr%type,
      p_pin_code   in customer.pin_code%type,
      p_city       in customer.city%type,
      p_address    in customer.address%type,
      p_user_id    out customer.user_id%type
   ) return number;

   function update_user_details (
      p_user_id   in customer.user_id%type,
      p_phone_nbr in customer.phone_nbr%type,
      p_email     in customer.email%type,
      p_pin_code  in customer.pin_code%type,
      p_city      in customer.city%type,
      p_address   in customer.address%type
   ) return number;

   function reset_password (
      p_user_id      in customer.user_id%type,
      p_password     in customer.password%type,
      p_new_password in customer.password%type
   ) return number;

end account_pkg;