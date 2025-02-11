declare begin

    --------------------------------------------------------
        --  DDL for View ACCOUNT_HOLDER_DETAILS
    --------------------------------------------------------
   begin
      execute immediate 'create or replace editionable view account_holder_details (
                                            user_id,
                                            bank_id,
                                            bank_name,
                                            branch_name,
                                            city,
                                            pin,
                                            account_nbr,
                                            first_name,
                                            last_name,
                                            dob,
                                            preferred_name,
                                            address,
                                            email,
                                            phone_nbr,
                                            pin_code
                                          ) as
                                            select c.user_id,
                                                    a.bank_id,
                                                    a.bank_name,
                                                    a.branch_name,
                                                    a.city,
                                                    a.pin,
                                                    b.account_nbr,
                                                    c.first_name,
                                                    c.last_name,
                                                    c.dob,
                                                    b.preferred_name,
                                                    c.address,
                                                    c.email,
                                                    c.phone_nbr,
                                                    c.pin_code
                                              from bank_master a,
                                                    account_holder b,
                                                    customer c
                                              where a.bank_id = b.bank_id
                                                and c.user_id = b.user_id';
   exception
      when others then
         raise;
   end;   
          --------------------------------------------------------
              --  DDL for View ACCOUNT_INVESTMENT_DETAILS_VW
          --------------------------------------------------------
   begin
      execute immediate 'create or replace editionable view account_investment_details_vw (
                                                user_id,
                                                bank_id,
                                                bank_name,
                                                branch_name,
                                                city,
                                                pin,
                                                account_nbr,
                                                first_name,
                                                last_name,
                                                preferred_name,
                                                dob,
                                                address,
                                                email,
                                                phone_nbr,
                                                pin_code,
                                                investment_id,
                                                instrument_id,
                                                instrument_assoc_bank,
                                                instrument_name,
                                                instrument_type,
                                                instrument_type_desc,
                                                investment_amt,
                                                investment_dt,
                                                investment_type,
                                                active_flag,
                                                instrument_closed_dt
                                              ) as
                                                select a.user_id,
                                                        a.bank_id,
                                                        a.bank_name,
                                                        a.branch_name,
                                                        a.city,
                                                        a.pin,
                                                        a.account_nbr,
                                                        a.first_name,
                                                        a.last_name,
                                                        a.preferred_name,
                                                        a.dob,
                                                        a.address,
                                                        a.email,
                                                        a.phone_nbr,
                                                        a.pin_code,
                                                        b.investment_id,
                                                        b.instrument_id,
                                                        b.instrument_assoc_bank,
                                                        b.instrument_name,
                                                        c.instrument_type,
                                                        c.instrument_type_desc,
                                                        b.investment_amt,
                                                        b.investment_dt,
                                                        b.investment_type,
                                                        b.active_flag,
                                                        b.instrument_closed_dt
                                                  from account_holder_details a
                                                  left join investment_details b
                                                on a.account_nbr = b.account_nbr
                                                  left join instrument_type c
                                                on c.instrument_type = b.instrument_type';
   exception
      when others then
         raise;
   end;
end;
/