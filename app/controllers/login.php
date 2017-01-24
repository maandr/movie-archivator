<?php
class Login extends Controller
{
	private $Model;

    function __construct() {
        parent::__construct();
        $this->Model = new LoginModel();
    }

    function index() {
        $this->assign('username', '');
        $this->render('admin/login.tpl');
    }

    function send()
    {
        if(!isset($_POST['submit']))
        {
            $this->index();
            return;
        }

        $form = new Form();
        $form->createField(FieldType::String, 'username');
        $form->createField(FieldType::String, 'password');
        $form->setFieldMessage('username', 'Bitte geben Sie Ihren Benutzernamen ein.');
        $form->setFieldMessage('password', 'Bitte geben Sie Ihr Password ein.');

        $form->parse($_POST);
        $data = $form->toArray();

        if(!$form->isValid())
        {
        	$this->handleFormErrors($form);
        	$this->assign($data);
        	$this->render('admin/login.tpl');
        	return;
        }

        $result = $this->Model->login($data);

        switch($result)
        {
			case -1:
				$this->accountLocked();
				break;
			case -2:
				$this->loginFailed();
				break;
			default:
				$this->loginSucceded($result);
				break;
		}
    }

    private function accountLocked()
    {
    	$this->assign('username', $_POST['username']);

    	$this->error('Security Locked.');
    	$this->render('admin/login.tpl');
    }

    private function loginFailed()
    {
    	$this->assign('username', $_POST['username']);

    	print_r($_POST['username']);

    	$this->error('Username und Password stimmen nicht überein.');
    	$this->render('admin/login.tpl');
    }

    private function loginSucceded($user)
    {
    	$_SESSION['loggedIn'] = true;
    	$_SESSION['userId'] = $user['id'];
    	$_SESSION['role'] = $user['role'];

    	Location::redirectTo('admin/dashboard');
    	exit();
    }
}
?>
