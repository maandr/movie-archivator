<?php
abstract class Controller {

	protected $controllerName;
  protected $view;
  protected $roles;
  protected $NotificationManager;
  protected $form;
  protected $service;
  protected $markdownParser;

	/* constructor */
  function __construct() {
		$this->controllerName = strtolower(get_class($this));
  	$this->view = new View();
  	$this->NotificationManager = new NotificationManager();
  	$this->markdownParser = new Parsedown();
		$this->roles = array();
    $this->initializeView();
  }

	/*
	 * Restricts the usage of the controller calling
	 * this method to the specified roles.
	 *
	 * @param roles Array of roles that are grantet
	 * 		permission to access the controller.
	 */
	protected function restrictedTo($roles) {
		$this->roles = $roles;

		if(!$this->accessAllowed()) {
  		Location::redirectTo('login');
  		exit();
  	}
	}

	/*
	 * Initializes the current template by assigning some
	 * globale values.
	 */
  private function initializeView() {
		$this->assign('ControllerName', $this->controllerName);
		$this->assign('Role', $this->getSessionRole());
    $this->assign('User', $this->getSessionUser());
  	$this->assign('BaseUrl', Location::baseUrl());
  	$this->assign('RequestUrl', Location::requestUrl());
  	$this->assign('DebugMode', DEBUG_MODE);
		$this->assign('ProjectName', PROJECT_NAME);
  }

	/*
	 * Determines wether or not the current session is allowed
	 * to access the requested controller.
	 *
	 * @return true in case the session is allowed; false otherwise.
	 */
  private function accessAllowed() {

		if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['role'])) {
			return false;
		}

		if($_SESSION['loggedIn'] != 1) {
			return false;
		}

		return $this->isAuthorized($_SESSION['role']);
  }

	/*
	 * Get the role of the session of the current request.
	 *
	 * @return string Role of the session.
	 *				 'visitor' - In case it's a visitor.
	 *				 'user'		 - In case it's a registered user.
	 *				 'admin'	 - In case it's a user with admin priviliges.
	 */
	private function getSessionRole() {
		if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['role'])) {
			return VISITOR;
		}

		if($_SESSION['loggedIn'] != 1) {
			return VISITOR;
		}

		return $_SESSION['role'];
	}

	/*
	 * Gets the user of the session of the current request.
	 *
	 * @return user User of the session.
	 */
	private function getSessionUser() {
		if(!isset($_SESSION['loggedIn']) || !isset($_SESSION['role'])) {
			return null;
		}

		if($_SESSION['loggedIn'] != 1) {
			return null;
		}

		return $_SESSION['user'];
	}

	/*
	 * Determines wether or not the passed role is allowed
	 * access to the controller.
	 *
	 * @param role Role to check authorization for.
	 * @return true in case the role is allowed; false otherwise.
	 */
  private function isAuthorized($role) {
  	return in_array($role, $this->roles);
  }

	/*
	 * Renders the specified template.
	 *
	 * @param template Template to render.
	 */
  protected function render($template) {
  	$this->view->assign('Errors', $this->NotificationManager->getErrors());
  	$this->view->assign('Warnings', $this->NotificationManager->getWarnings());
  	$this->view->assign('Infos', $this->NotificationManager->getInfos());
  	$this->view->render($template);
  }

	/*
	 * Handels the errors of the passed form by creating
	 * an error notifications for each of them.
	 *
	 * @param form Form to handle errors for.
	 */
	protected function handleFormErrors($form) {
  	foreach($form->getErrors() as $formError) {
  		$this->error($formError);
  	}
  }

	/*
	 * Assings a varaible to the view.
	 *
	 * @param key Single placeholder in the template to add
	 *				or an array of key values to add.
	 * @param (optional) value Value for the passed key.
	 */
  protected function assign($key, $value = null) {
  	if(is_array($key)) {
			$this->view->assignArray($key);
		} else {
			$this->view->assign($key, $value);
		}
  }

	/*
	 * Display an screen error notification
	 *
	 * @param message Message to display.
	 */
  protected function error($message) {
  	$this->NotificationManager->Error($message);
  }

	/*
	 * Display an screen warning notification
	 *
	 * @param message Message to display.
	 */
  protected function warning($message) {
  	$this->NotificationManager->Warning($message);
  }

	/*
	 * Display an screen info notification
	 *
	 * @param message Message to display.
	 */
  protected function info($message) {
  	$this->NotificationManager->Info($message);
  }

	/* Each controller has to provide a index method */
  public function index() {}
}
?>
