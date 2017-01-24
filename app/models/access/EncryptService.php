<?php
class EncryptService {

  /* constructor */
  function __construct() {}

  /*
   * Creates a SHA-256 hash from the passed value.
   *
   * @param value Value to hash.
   */
  public function createSHA256($value) {
     return hash('sha256', $value);
  }

  /*
   * Compares a plain value with a SHA-256 hash.
   *
   * @param plain Plaintext value to compare.
   * @param encrypted SHA-256 encrypted value to compare with.
   */
  public function isValid($plain, $encrypted) {
    return $encrypted === hash('sha256', $plain);
  }
}
?>
