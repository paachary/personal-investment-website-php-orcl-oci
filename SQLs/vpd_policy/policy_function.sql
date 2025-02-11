create or replace function get_user_policy (
   schema_p in varchar2,
   table_p  in varchar2
) return varchar2 as
   l_policy_pred varchar2(400);
   l_user_name   varchar2(100);
   l_user_id     number;
begin
   l_user_name := sys_context(
      'finance_ctx',
      'user_name'
   );
   l_user_id := sys_context(
      'finance_ctx',
      'user_id'
   );
   if ( lower(l_user_name) != 'sysadmin' ) then
      l_policy_pred := 'user_id = ' || l_user_id;
   else
      l_policy_pred := '1 = 1';
   end if;
   return l_policy_pred;
end;