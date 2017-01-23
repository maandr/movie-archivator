<?php
class Validator
{
  public static function isBlank($var) {
    return (strlen(trim($var)) > 0) ? false : true;
  }

  public static function isIP($var) {
    return filter_var($var, FILTER_VALIDATE_IP);
  }

  public static function isMAC($var) {
    return filter_var($var, FILTER_VALIDATE_MAC);
  }

  public static function isUrl($var) {
    return filter_var($var, FILTER_VALIDATE_URL);
  }

  public static function isInteger($var) {
    return filter_var($var, FILTER_VALIDATE_INT);
  }

  public static function isFloat($var) {
    return filter_var($var, FILTER_VALIDATE_FLOAT);
  }

  public static function isBoolean($var) {
    return filter_var($var, FILTER_VALIDATE_BOOLEAN);
  }

  public static function isEmail($var) {
    return filter_var($var, FILTER_VALIDATE_EMAIL);
  }
}
?>
