<?php
class Index extends Controller {

  protected $AccessService;

  function __construct() {
    parent::__construct();
    $this->AccessService = new AccessService();
  }

  public function index() {
    $this->home();
  }

  public function home() {
    $this->render('home.tpl');
  }

  public function login() {

    if(!isset($_POST['submit'])) {
      $this->assign(['username' => '',]);
      return $this->render('login.tpl');
    }

    $form = new Form();
    $form->createField(FieldType::String, 'username');
    $form->createField(FieldType::String, 'password');
    $form->setFieldMessage('username', 'Please provide an username.');
    $form->setFieldMessage('password', 'Please provide a password.');

    $form->parse($_POST);
    $data = $form->toArray();

    if(!$form->isValid()) {
      $this->handleFormErrors($form);
      $this->assign($data);
      $this->render('admin/login.tpl');
      return;
    }

    try
    {
      $username = $data['username'];
      $password = $data['password'];

      $user = $this->AccessService->login($username, $password);

      $_SESSION['loggedIn'] = true;
      $_SESSION['user'] = $user;
      $_SESSION['userId'] = $user->id;
      $_SESSION['role'] = $user->role;
      Location::redirectTo('dashboard');
    }
    catch(AccountIsLockedException $e)
    {
      $this->error('Your account is currently locked because of to many failed login attempts. Please try again in an hour.');
      return $this->render('login.tpl');
    }
    catch(AccountIsBannedException $e)
    {
      $this->error('Your account was banned.');
      return $this->render('login.tpl');
    }
    catch(LoginFailedException $e)
    {
      $this->assign('username', $data['username']);
      $this->error('Username and password are not matching.');
      return $this->render('login.tpl');
    }
    catch(UserNotFoundException $e)
    {
      $this->assign('username', $data['username']);
      $this->error('Username and password are not matching.');
      return $this->render('login.tpl');
    }
  }

  public function logout() {
    session_destroy();
    $this->login();
  }

  public function register() {

    if(!isset($_POST['submit'])) {
      $this->assign([
        'username' => '',
        'email' => '',
        'firstname' => '',
        'lastname' => ''
      ]);
      return $this->render('register.tpl');
    }

    $form = new Form();
    $form->createField(FieldType::String, 'username');
    $form->createField(FieldType::Email, 'email');
    $form->createField(FieldType::String, 'password');
    $form->createField(FieldType::String, 'confirm-password');
    $form->createField(FieldType::Optional, 'firstname');
    $form->createField(FieldType::Optional, 'lastname');
    $form->setFieldMessage('username', 'Please provide an username.');
    $form->setFieldMessage('email', 'Please provide an valid email address.');
    $form->setFieldMessage('password', 'Please provide a password.');
    $form->setFieldMessage('confirm-password', 'Please confirm your password.');

    $form->parse($_POST);
    $data = $form->toArray();

    if(!$form->isValid()) {
      $this->handleFormErrors($form);
      $this->assign($data);
      return $this->render('register.tpl');
    }

    if($data['confirm-password'] !== $data['password']) {
      $this->error('The password you confirmed does not match you password.');
      $this->assign($data);
      return $this->render('register.tpl');
    }

    unset($data['confirm-password']);
    $this->AccessService->createAccount($data);

    $_SESSION['loggedIn'] = true;
    $_SESSION['user'] = $user;
    $_SESSION['userId'] = $user->id;
    $_SESSION['role'] = $user->role;
    Location::redirectTo('dashboard');
  }

  public function forgot_password() {
    if(!isset($_POST['submit'])) {
      $this->assign([
        'email' => ''
      ]);
      return $this->render('forgot-password.tpl');
    }

    $form = new Form();
    $form->createField(FieldType::Email, 'email');
    $form->setFieldMessage('email', 'Please provide an valid email address.');

    $form->parse($_POST);
    $data = $form->toArray();

    if(!$form->isValid()) {
      $this->handleFormErrors($form);
      $this->assign($data);
      return $this->render('forgot-password.tpl');
    }

    try
    {
      $this->AccessService->requestPasswordReset($data['email']);
      return $this->render('password-requested.tpl');
    }
    catch(UserNotFoundException $e)
    {
      $this->assign('email', $data['email']);
      $this->error('An account for the requested email '.$data['email'].' does not exist.');
      return $this->render('forgot-password.tpl');
    }
  }

  public function set_password() {
    if(!isset($_POST['submit'])) {
      $this->assign([
        'token' => (isset($_GET['token'])) ? $_GET['token'] : ''
      ]);
      return $this->render('set-password.tpl');
    }

    $form = new Form();
    $form->createField(FieldType::String, 'password');
    $form->createField(FieldType::String, 'confirm-password');
    $form->createField(FieldType::String, 'token');
    $form->setFieldMessage('password', 'Please provide a password.');
    $form->setFieldMessage('confirm-password', 'Please confirm your password.');
    $form->setFieldMessage('token', 'You require a valid token to perform this operation.');

    $form->parse($_POST);
    $data = $form->toArray();

    if(!$form->isValid()) {
      $this->handleFormErrors($form);
      $this->assign($data);
      $this->render('set-password.tpl');
      return;
    }

    if($data['confirm-password'] !== $data['password']) {
      // ToDo: This message dosen't work yet.
      $form->setFieldMessage('confirm-password', 'The password you confirmed does not match you password.');
      $this->handleFormErrors($form);
      $this->assign($data);
      $this->render('set-password.tpl');
      return;
    }

    $this->AccessService->setNewPassword($data['password'], $data['token']);
    return $this->render('password-changed.tpl');
    // ToDo: handle token not found..
  }
}
?>
