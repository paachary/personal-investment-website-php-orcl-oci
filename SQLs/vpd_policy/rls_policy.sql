begin
   dbms_rls.drop_policy(
      user,
      'ACCOUNT_INVESTMENT_DETAILS_VW',
      'get_user_policy'
   );
end;
/
begin
   dbms_rls.drop_policy(
      user,
      'ACCOUNT_HOLDER_DETAILS',
      'get_user_policy'
   );
end;
/

begin
   dbms_rls.drop_policy(
      user,
      'account_holder',
      'get_user_policy'
   );
end;
/

begin
   begin
      dbms_rls.add_policy(
         object_schema   => user,
         object_name     => 'account_holder',
         policy_name     => 'get_user_policy',
         function_schema => user,
         policy_function => 'get_user_policy',
         statement_types => 'select'
      );
   end;


   begin
      dbms_rls.add_policy(
         object_schema   => user,
         object_name     => 'ACCOUNT_HOLDER_DETAILS',
         policy_name     => 'get_user_policy',
         function_schema => user,
         policy_function => 'get_user_policy',
         statement_types => 'select'
      );
   end;

   begin
      dbms_rls.add_policy(
         object_schema   => user,
         object_name     => 'ACCOUNT_INVESTMENT_DETAILS_VW',
         policy_name     => 'get_user_policy',
         function_schema => user,
         policy_function => 'get_user_policy',
         statement_types => 'select'
      );
   end;
end;
/