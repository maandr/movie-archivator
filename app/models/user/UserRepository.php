<?php
class UserRepository extends Repository {

  /* constructor */
  function __construct() {
    parent::__construct('users');
  }

  public function getUserByUsername($username) {
    $results = $this->Database
      ->select("SELECT * FROM users WHERE username = :username",
        ['username' => $username]);

    if(count($results) <= 0) {
      throw new UserNotFoundException();
    }

    return $results[0];
  }
}

class UserNotFoundException extends Exception {}
?>
