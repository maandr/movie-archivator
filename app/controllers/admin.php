<?php
class Admin extends AdminController
{
    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$this->render('admin/dashboard.tpl');
    }

    public function dashboard() {
    	$this->render('admin/dashboard.tpl');
    }

    public function logout() {
    	session_destroy();
    	Location::redirectTo('login');
    }
}
?>
