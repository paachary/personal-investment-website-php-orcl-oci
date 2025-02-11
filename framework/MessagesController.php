<?php

class MessagesController
{

  static $updMsg = "Are you sure you want to update this record?";

  static $delMsg = "Are you sure you want to delete this record?";

  static $closureMsg = "Are you sure you want to close this record?";

  public static function updateMsg()
  {
    return [
      "title" => "Record Update Warning",
      "body" => self::$updMsg,
      "button" => "Update"
    ];
  }

  public static function deleteMsg()
  {
    return [
      "title" => "Record Delete Warning",
      "body" => self::$delMsg,
      "button" => "Delete"
    ];
  }

  public static function closureMsg()
  {
    return [
      "title" => "Record Closure Warning",
      "body" => self::$closureMsg,
      "button" => "Close"
    ];
  }

  public static function setDeleteMsg($msg)
  {
    self::$delMsg = $msg . "<br>" . self::$delMsg;
  }

  public static function setUpdateMsg($msg)
  {
    self::$updMsg = $msg . "<br>" . self::$updMsg;
  }

  public static function setClosureMsg($msg)
  {
    self::$closureMsg = $msg . "<br>" . self::$closureMsg;
  }
}
