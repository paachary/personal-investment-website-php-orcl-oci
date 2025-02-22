begin
   begin
      begin
         execute immediate 'alter table account_holder add (user_id number)';
      exception
         when others then
            null;
      end;
      begin
         execute immediate 'alter table account_holder set unused ( first_name,
                                        last_name,
                                        address,
                                        pin_code,
                                        phone_nbr,
                                        email )';
      exception
         when others then
            null;
      end;
      begin
         execute immediate 'alter table account_holder drop unused columns';
      exception
         when others then
            null;
      end;
   end;

   begin
      execute immediate 'alter table investment_instrument_type rename column investment_id to instrument_type_id';
   exception
      when others then
         null;
   end;
   begin
      execute immediate 'alter table investment_instrument_type rename column investment_type to instrument_type';
   exception
      when others then
         null;
   end;
   begin
      execute immediate 'alter table investment_instrument_type rename column investment_desc to instrument_type_desc';
   exception
      when others then
         null;
   end;
   begin
      execute immediate 'alter table investment_instrument_type rename to instrument_type';
   exception
      when others then
         null;
   end;
   begin
      execute immediate 'alter table investment_details rename column type to investment_type';
   exception
      when others then
         null;
   end;
   begin
      execute immediate 'alter table bank_master modify (city varchar2(50))';
   exception
      when others then
         null;
   end;
end;
/