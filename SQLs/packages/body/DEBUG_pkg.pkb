--------------------------------------------------------
--  DDL for Package Body DEBUG
--------------------------------------------------------

create or replace editionable package body debug as

   procedure debug (
      p_str varchar2
   ) as
      pragma autonomous_transaction;
   begin
    -- TODO: Implementation required for PROCEDURE DEBUG.debug
      insert into debug_tab values ( p_str );
      commit;
   end debug;

end debug;
/