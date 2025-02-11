create or replace package body ctx_pkg as
   g_session_id number;

   procedure set_session_id (
      p_session_id in number
   ) as
   begin
      g_session_id := p_session_id;
      dbms_session.set_identifier(p_session_id);
   end;
   procedure set_ctx (
      p_sec_level_attr in varchar2,
      p_sec_level_val  in varchar2
   ) as
   begin
      dbms_session.set_context(
         namespace => 'finance_ctx',
         attribute => p_sec_level_attr,
         value     => p_sec_level_val,
         username  => user,
         client_id => g_session_id
      );
   end;
   procedure clear_session (
      p_session_id in number
   ) as
   begin
      dbms_session.set_identifier(p_session_id);
      dbms_session.clear_identifier;
   end;

   procedure clear_context as
   begin
      dbms_session.clear_context(
         'finance_ctx',
         g_session_id
      );
   end;

end;