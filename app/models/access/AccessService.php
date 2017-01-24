<?php
class AccessService {

  protected $UserRepository;
  protected $EncryptService;
  protected $Database;

  /* constructor */
  function __construct() {
    $this->UserRepository = new UserRepository();
    $this->EncryptService = new EncryptService();
    $this->Database = Database::getInstance();
  }

  /*
   * Creates a new user account from the passed data.
   * data format: ['username' => 'name', ... ]
   *
   * @param data Data to create a new account from.
   */
  public function createAccount($data) {
    $data['password'] = $this->EncryptService->createSHA256($data['password']);
    $this->UserRepository->create($data);
  }

  /*
   * Attempt to login.
   *
   * @param username Name of the user that attempts to login.
   * @param password Password the user tried to login with.
   * @return int -1 = account security locked;
   *             -2 = login attempt failed
   * @return user User object in case the login was successful.
   */
  public function login($username, $password) {

      $user = $this->UserRepository->getUserByUsername($username);

      if($this->isSecurityLocked($user)) {
        throw new AccountIsLockedException();
      }

      if(!$this->isPasswordCorrect($user, $password)) {
        $this->createLoginAttempt($user);
        throw new LoginFailedException();
      }

      return $user;
  }

  /*
   * Determines if the given password is matching the
   * password of the passed user.
   *
   * @param user User to use.
   * @param password Password to match.
   * @return bool true in case of match; false otherwise.
   */
  public function isPasswordCorrect($user, $password) {
    return $this->EncryptService->isValid($password, $user->password);
  }

  /*
   * Determines if the passed user is currently securitly
   * locked because of suspicion of brute force.
   *
   * @param user User to check.
   * @return bool true in case the user is locked; false otherwise.
   */
  public function isSecurityLocked($user) {
    $attempts = $this->getAmountOfLoginAttempts($user);
    return (isset($attempts) && $attempts > LOCK_AFTER_LOGIN_ATTEMPTS);
  }

  /*
   * Gets the amount of login attempts of the passed
   * user within the last hour.
   *
   * @param user User to check.
   * @return int Amount of login attempts within the last hour.
   */
  public function getAmountOfLoginAttempts($user) {
    $results = $this->Database
      ->select("SELECT COUNT(id) AS count FROM login_attempts WHERE id = :id AND time >= DATE_SUB(NOW(), INTERVAL 1 HOUR)",
        ['id' => $user->id]);
    return $results[0]->count;
  }

  /*
   * Persists a login attempt for the passed user to the database.
   *
   * @param user User to create a login attempt for.
   */
  public function createLoginAttempt($user) {
    $this->Database->insert('login_attempts', ['id' => $user->id]);
  }
}

class AccountIsLockedException extends Exception {}
class AccountIsBannedException extends Exception {}
class LoginFailedException extends Exception {}
?>
