<?php
class Users extends AdminController
{
	private $userRoles = array('owner','admin','moderator','user');
	
    function __construct()
    {
        parent::__construct();

        $this->service = new UserService();
        
        $this->form = new Form();
        $this->form->createField(FieldType::String, 'username');
        $this->form->createField(FieldType::Encrypted, 'password');
        $this->form->createField(FieldType::String, 'role');
        $this->form->setFieldMessage('username', 'Bitte geben Sie einen Benutzernamen ein.');
        $this->form->setFieldMessage('password', 'Bitte geben Sie ein Password ein.');
        
        $this->assign('Roles', $this->userRoles);
    }

    public function index()
    {
        $this->assign('username', '');
        $this->render('admin/login.tpl');
    }
}
?>
