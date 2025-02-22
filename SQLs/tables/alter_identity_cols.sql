declare
   lv_max number;
begin
   select nvl(
      max(investment_id),
      0
   )
     into lv_max
     from investment_details;

   lv_max := lv_max + 1;
   execute immediate 'alter table investment_details 
   modify (investment_id  generated by default as identity
    (start with '
                     || lv_max
                     || '
    increment by 1
    ))';
   select nvl(
      max(user_id),
      0
   )
     into lv_max
     from customer;

   lv_max := lv_max + 1;
   execute immediate 'alter table customer modify ( USER_ID number generated by default as identity
    (start with '
                     || lv_max
                     || '
    increment by 1
    ))';
   select nvl(
      max(instrument_type_id),
      0
   )
     into lv_max
     from instrument_type;

   lv_max := lv_max + 1;
   execute immediate 'alter table instrument_type modify ( instrument_type_id number generated by default as identity
    (start with '
                     || lv_max
                     || '
    increment by 1
    ))';
end;