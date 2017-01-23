<?php
abstract class Controller
{
	protected $controllerName;
  protected $view;
  protected $roles;
  protected $notificationManager;
  protected $form;
  protected $service;
  protected $markdownParser;

  function __construct($skipAuthorization = false) {
  	$this->view = new View();
  	$this->roles = array();
  	$this->notificationManager = new NotificationManager();
  	$this->markdownParser = new Parsedown();
    $this->initView();

    $this->controllerName = strtolower(get_class($this));
    $this->assign('ControllerName', $this->controllerName);
  }

	public function getControllerName() {
		return $this->controllerName;
	}

  private function initView() {
  	$this->view->assign('BaseUrl', Location::baseUrl());
  	$this->view->assign('RequestUrl', Location::requestUrl());
  	$this->view->assign('DebugMode', DEBUG_MODE);
  }

  protected function verifyAuthorization() {
  	if(!$this->accessAllowed()) {
  		Location::redirectTo('login');
  		exit();
  	}
  }

  private function accessAllowed() {
		if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['role']))
			return false;

		if($_SESSION['loggedIn'] != 1)
			return false;

		return $this->isAuthorized($_SESSION['role']);
  }

  protected function isAuthorized($role) {
  	return in_array($role, $this->roles);
  }

  protected function authorizeRole($roleName) {
		array_push($this->roles, $roleName);
  }

  protected function render($template) {
  	$this->view->assign('Errors', $this->notificationManager->getErrors());
  	$this->view->assign('Warnings', $this->notificationManager->getWarnings());
  	$this->view->assign('Infos', $this->notificationManager->getInfos());
  	$this->view->render($template);
  }

  protected function assign($key, $value = null) {
  	if(is_array($key)) {
			$this->view->assignArray($key);
		} else {
			$this->view->assign($key, $value);
		}
  }

  protected function handleFormErrors($form) {
  	foreach($form->getErrors() as $formError) {
  		$this->error($formError);
  	}
  }

  protected function error($message) {
  	$this->notificationManager->Error($message);
  }

  protected function warning($message) {
  	$this->notificationManager->Warning($message);
  }

  protected function info($message) {
  	$this->notificationManager->Info($message);
  }

  public abstract function index();
}
?>
