create or replace package body "ACCOUNT_PKG" as


/* 
   Account Entity
*/
   function get_all_accounts return sys_refcursor as
      accounts_cur sys_refcursor;
   begin
      open accounts_cur for select user_id,
                                   bank_id,
                                   bank_name,
                                   branch_name,
                                   city,
                                   account_nbr,
                                   first_name,
                                   last_name,
                                   preferred_name
                              from account_holder_details;

      return accounts_cur;
   end;

   function get_account_details (
      p_account_nbr in account_holder.account_nbr%type
   ) return sys_refcursor as
      accounts_cur sys_refcursor;
   begin
      open accounts_cur for select user_id,
                                   bank_id,
                                   bank_name,
                                   branch_name,
                                   city,
                                   pin,
                                   account_nbr,
                                   first_name,
                                   last_name,
                                   preferred_name,
                                   phone_nbr,
                                   email,
                                   address,
                                   pin_code
                                                    from account_holder_details
                             where account_nbr = p_account_nbr;

      return accounts_cur;
   end;

   function get_preferred_names return sys_refcursor as
      l_preferred_names_cur sys_refcursor;
   begin
      open l_preferred_names_cur for select preferred_name,
                                            account_nbr
                                       from account_holder;

      return l_preferred_names_cur;
   end;

   procedure update_account_details (
      p_account_nbr    in account_holder.account_nbr%type,
      p_preferred_name in account_holder.preferred_name%type
   ) as
   begin
      update account_holder
         set
         preferred_name = p_preferred_name
       where account_nbr = p_account_nbr;

   end;

   procedure set_account_details (
      p_user_id        in account_holder.user_id%type default 0,
      p_bank_id        in account_holder.bank_id%type,
      p_account_nbr    in account_holder.account_nbr%type,
      p_preferred_name in account_holder.preferred_name%type,
      p_status         out number
   ) as
      l_bank_abbr varchar2(100);
      l_count     number;
   begin
      select count(*)
        into l_count
        from account_holder
       where account_nbr = p_account_nbr;

      if ( l_count > 0 ) then
         p_status := 1;
      else
         begin
            select bank_abbr
                   || '-'
                   || substr(
               city,
               1,
               3
            )
              into l_bank_abbr
              from bank_master
             where bank_id = p_bank_id;

         exception
            when no_data_found then
               p_status := 1;
               return;
         end;

         insert into account_holder (
            user_id,
            bank_id,
            account_nbr,
            preferred_name
         ) values ( p_user_id,
                    p_bank_id,
                    p_account_nbr,
                    p_preferred_name
                    || '-'
                    || l_bank_abbr );
         p_status := 0;
      end if;
   end;

   procedure delete_account (
      p_account_nbr in account_holder.account_nbr%type
   ) is
      type l_investment_id_tab is
         table of number index by binary_integer;
      l_investment_ids l_investment_id_tab;
   begin
      select investment_id
      bulk collect
        into l_investment_ids
        from investment_details
       where account_nbr = p_account_nbr;

      if
         l_investment_ids is not null
         and l_investment_ids.count > 0
      then
         forall i in 1..l_investment_ids.count
            delete investment_details
             where investment_id = l_investment_ids(i);
      end if;

      delete account_holder
       where account_nbr = p_account_nbr;
   end;

   /* 
      End of Account entity
   */

   /*
      Investment Entity
   */

   function get_savings_by_account (
      p_account_nbr in account_holder.account_nbr%type
   ) return sys_refcursor as
      saving_dtls sys_refcursor;
   begin
      open saving_dtls for select user_id,
                                  bank_id,
                                  bank_name,
                                  branch_name,
                                  city,
                                  pin,
                                  account_nbr,
                                  first_name,
                                  last_name,
                                  preferred_name,
                                  address,
                                  email,
                                  phone_nbr,
                                  pin_code,
                                  investment_id,
                                  instrument_id,
                                  instrument_assoc_bank,
                                  instrument_name,
                                  instrument_type_desc as instrument_type,
                                  investment_amt,
                                  investment_dt,
                                  case investment_type
                                                   when 'ONE_TIME' then
                                                      'One Time Investment'
                                                   when 'SWP'      then
                                                      'Systematic Withdrawal Plan'
                                                   when 'SIP'      then
                                                      'Systematic Investment Plan'
                                                   else
                                                      'Undefined'
                                  end as investment_type,
                                  active_flag,
                                  instrument_closed_dt
                                                  from account_investment_details_vw
                            where account_nbr = p_account_nbr;

      return saving_dtls;
   end;

   function get_investment_details (
      p_investment_id account_investment_details_vw.investment_id%type
   ) return sys_refcursor as
      saving_dtls sys_refcursor;
   begin
      open saving_dtls for select user_id,
                                  bank_id,
                                  bank_name,
                                  branch_name,
                                  city,
                                  pin,
                                  account_nbr,
                                  first_name,
                                  last_name,
                                  preferred_name,
                                  address,
                                  email,
                                  phone_nbr,
                                  pin_code,
                                  investment_id,
                                  instrument_id,
                                  instrument_assoc_bank,
                                  instrument_name,
                                  instrument_type_desc as instrument_type,
                                  investment_amt,
                                  investment_dt,
                                  case investment_type
                                                   when 'ONE_TIME' then
                                                      'One Time Investment'
                                                   when 'SWP'      then
                                                      'Systematic Withdrawal Plan'
                                                   when 'SIP'      then
                                                      'Systematic Investment Plan'
                                                   else
                                                      'Undefined'
                                  end as investment_type,
                                  active_flag,
                                  instrument_closed_dt
                                                  from account_investment_details_vw
                            where investment_id = p_investment_id;

      return saving_dtls;
   end;

   procedure close_investment (
      p_investment_id account_investment_details_vw.investment_id%type
   ) as
   begin
      update investment_details
         set instrument_closed_dt = sysdate,
             active_flag = 'N'
       where investment_id = p_investment_id;

   end;

   procedure delete_investment (
      p_investment_id account_investment_details_vw.investment_id%type
   ) as
   begin
      delete investment_details
       where investment_id = p_investment_id;

   end;

   procedure set_savings_for_account (
      p_account_nbr           in investment_details.account_nbr%type,
      p_instrument_type       in investment_details.instrument_type%type,
      p_instrument_id         in investment_details.instrument_id%type,
      p_instrument_name       in investment_details.instrument_name%type,
      p_instrument_assoc_bank in investment_details.instrument_assoc_bank%type,
      p_investment_amount     in investment_details.investment_amt%type,
      p_investment_type       in investment_details.investment_type%type,
      p_investment_dt         in investment_details.investment_dt%type
   ) as
   begin
      insert into investment_details (
         account_nbr,
         instrument_type,
         instrument_id,
         instrument_name,
         instrument_assoc_bank,
         investment_amt,
         investment_type,
         investment_dt,
         active_flag
      ) values ( p_account_nbr,
                 p_instrument_type,
                 p_instrument_id,
                 p_instrument_name,
                 p_instrument_assoc_bank,
                 p_investment_amount,
                 p_investment_type,
                 p_investment_dt,
                 'Y' );

   end;

   /*
      End of Investment Entity
   */

   /*
      Customer Entity
   */

   function get_user_details (
      p_user_name in customer.user_name%type
   ) return sys_refcursor is
      l_user_details_cur sys_refcursor;
   begin
      open l_user_details_cur for select user_id,
                                         password,
                                         user_name,
                                         first_name,
                                         last_name,
                                         dob,
                                         gender,
                                         phone_nbr,
                                         email,
                                         pin_code,
                                         city,
                                         address
                                                                from customer
                                   where upper(user_name) = upper(p_user_name);
      return l_user_details_cur;
   end;

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
   ) return number is
      l_count number;
      l_ret   number;
   begin
      select count(1)
        into l_count
        from customer
       where user_name = p_user_name;

      if l_count > 0 then
         l_ret := 1;
      else
         insert into customer (
            user_name,
            password,
            first_name,
            last_name,
            dob,
            gender,
            email,
            phone_nbr,
            city,
            address,
            pin_code
         ) values ( p_user_name,
                    p_password,
                    p_first_name,
                    p_last_name,
                    p_dob,
                    p_gender,
                    p_email,
                    p_phone_nbr,
                    p_city,
                    p_address,
                    p_pin_code ) returning user_id into p_user_id;
         l_ret := 0;
      end if;
      return l_ret;
   end;


   function update_user_details (
      p_user_id   in customer.user_id%type,
      p_phone_nbr in customer.phone_nbr%type,
      p_email     in customer.email%type,
      p_pin_code  in customer.pin_code%type,
      p_city      in customer.city%type,
      p_address   in customer.address%type
   ) return number is
      l_status number := 0;
   begin
      update customer
         set phone_nbr = p_phone_nbr,
             email = p_email,
             pin_code = p_pin_code,
             city = p_city,
             address = p_address
       where user_id = p_user_id;

      if ( sql%rowcount > 0 ) then
         l_status := 0;
      else
         l_status := 1;
      end if;

      return l_status;
   end;

   function reset_password (
      p_user_id      in customer.user_id%type,
      p_password     in customer.password%type,
      p_new_password in customer.password%type
   ) return number is
      l_status number;
   begin
      update customer
         set
         password = p_new_password
       where password = p_password
         and user_id = p_user_id;

      if ( sql%rowcount > 0 ) then
         l_status := 0;
      else
         l_status := 1;
      end if;
      return l_status;
   end;

   /*
      End of Customer Entity
   */

/* 
   Bank Entity
*/

   function get_bank_details return sys_refcursor is
      bank_dtls_cur sys_refcursor;
   begin
      open bank_dtls_cur for select bank_id as name,
                                    bank_abbr
                                    || '-'
                                    || substr(
                                       city,
                                       1,
                                       3
                                    ) as value
                               from bank_master;

      return bank_dtls_cur;
   end;


   function get_bank_master_details return sys_refcursor is
      bank_dtls_cur sys_refcursor;
   begin
      open bank_dtls_cur for select bank_id,
                                    bank_name,
                                    branch_name,
                                    bank_abbr,
                                    city,
                                    pin
                               from bank_master;

      return bank_dtls_cur;
   end;

   function get_bank_master_details (
      p_bank_id in bank_master.bank_id%type
   ) return sys_refcursor is
      bank_dtls_cur sys_refcursor;
   begin
      open bank_dtls_cur for select bank_id,
                                    bank_name,
                                    branch_name,
                                    bank_abbr,
                                    city,
                                    pin
                                                      from bank_master
                              where bank_id = p_bank_id;

      return bank_dtls_cur;
   end;

   function insert_bank_details (
      p_bank_name   bank_master.bank_name%type,
      p_branch_name bank_master.branch_name%type,
      p_city        bank_master.city%type,
      p_pin         bank_master.pin%type,
      p_bank_abbr   bank_master.bank_abbr%type
   ) return number is
      l_status number;
      l_count  number;
   begin
      select count(1)
        into l_count
        from bank_master
       where bank_name = p_bank_name
         and branch_name = p_branch_name;

      if ( l_count > 0 ) then
         l_status := 1;
      else
         insert into bank_master (
            bank_name,
            branch_name,
            city,
            pin,
            bank_abbr
         ) values ( p_bank_name,
                    p_branch_name,
                    p_city,
                    p_pin,
                    p_bank_abbr );

         l_status := 0;
      end if;
      return l_status;
   end;

   procedure update_bank_details (
      p_bank_id   in bank_master.bank_id%type,
      p_bank_abbr bank_master.bank_abbr%type,
      p_pin       in bank_master.pin%type,
      p_city      in bank_master.city%type
   ) is
   begin
      update bank_master
         set pin = p_pin,
             city = p_city,
             bank_abbr = p_bank_abbr
       where bank_id = p_bank_id;
   end;  


   /*
      End of Bank Entity
   */


   /*
      Instrument Types Entity
   */


   function get_instrument_types return sys_refcursor as
      instrument_types_cur sys_refcursor;
   begin
      open instrument_types_cur for select instrument_type_id,
                                           instrument_type,
                                           instrument_type_desc
                                      from instrument_type;

      return instrument_types_cur;
   end;

   function get_instrument_type (
      p_instrument_type_id in instrument_type.instrument_type_id%type
   ) return sys_refcursor as
      instrument_types_cur sys_refcursor;
   begin
      open instrument_types_cur for select instrument_type_id,
                                           instrument_type,
                                           instrument_type_desc
                                                                    from instrument_type
                                     where instrument_type_id = p_instrument_type_id;

      return instrument_types_cur;
   end;

   procedure update_instrument_type (
      p_instrument_type_id   in instrument_type.instrument_type_id%type,
      p_instrument_type_desc in instrument_type.instrument_type_desc%type
   ) is
   begin
      update instrument_type
         set
         instrument_type_desc = p_instrument_type_desc
       where instrument_type_id = p_instrument_type_id;
   end;

   function insert_instrument_type (
      p_instrument_type      in instrument_type.instrument_type%type,
      p_instrument_type_desc in instrument_type.instrument_type_desc%type
   ) return number is
      l_status number;
      l_count  number;
   begin
      select count(1)
        into l_count
        from instrument_type
       where instrument_type = p_instrument_type;

      if ( l_count > 0 ) then
         l_status := 1;
      else
         insert into instrument_type (
            instrument_type,
            instrument_type_desc
         ) values ( p_instrument_type,
                    p_instrument_type_desc );

         l_status := 0;
      end if;
      return l_status;
   end;

   /*
      End Instrument Types Entity
   */


   /*
      Reports
   */

   function get_active_investment_rpt return sys_refcursor is
      l_active_investment_rpt_cur sys_refcursor;
   begin
      open l_active_investment_rpt_cur for select b.bank_abbr as bank_short_name,
                                                  a.account_nbr as debit_account_number,
                                                  d.first_name
                                                  || ' '
                                                  || d.last_name as account_holder_name,
                                                  c.preferred_name as account_holder_peferred_name,
                                                  a.total_investment_amt as total_invested_amount,
                                                  sum(total_investment_amt)
                                                  over() as cumulative_sum
                                                                                  from (
                                                                                   select account_nbr,
                                                                                          sum(investment_amt) as total_investment_amt
                                                                                     from investment_details
                                                                                    where active_flag = 'Y'
                                                                                      and investment_type = 'ONE_TIME'
                                                                                    group by account_nbr
                                                                                ) a,
                                                                                       bank_master b,
                                                                                       account_holder c,
                                                                                       customer d
                                            where b.bank_id = c.bank_id
                                              and a.account_nbr = c.account_nbr
                                              and d.user_id = c.user_id;

      return l_active_investment_rpt_cur;
   end;


   function get_monthly_debit_rpt return sys_refcursor is
      l_monthly_debit_rpt_cur sys_refcursor;
   begin
      open l_monthly_debit_rpt_cur for select b.bank_abbr as bank_short_name,
                                              a.account_nbr as debit_account_number,
                                              d.first_name
                                              || ' '
                                              || d.last_name as account_holder_name,
                                              c.preferred_name as account_holder_peferred_name,
                                              a.total_investment_amt as total_invested_amount,
                                              sum(total_investment_amt)
                                              over() as cumulative_sum
                                                                          from (
                                                                           select account_nbr,
                                                                                  sum(investment_amt) as total_investment_amt
                                                                             from investment_details
                                                                            where active_flag = 'Y'
                                                                              and investment_type = 'SIP'
                                                                            group by account_nbr
                                                                        ) a,
                                                                               bank_master b,
                                                                               account_holder c,
                                                                               customer d
                                        where b.bank_id = c.bank_id
                                          and a.account_nbr = c.account_nbr
                                          and d.user_id = c.user_id;

      return l_monthly_debit_rpt_cur;
   end;

/* 
   End of Reports
*/
end;