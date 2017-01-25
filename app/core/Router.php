<?php
class Router {

  /* constructor */
  function __construct() {}

  /*
   * Processes the current request.
   * Delegates the request to the appropriate controller.
   */
  public function processRequest() {

    $requestUri = (isset($_GET['url'])) ? $_GET['url'] : '';

    $Request = $this->parseUri($requestUri);

    if($this->existsController($Request->controller)) {

      $Controller = $this->createController($Request->controller);

      if(method_exists($Controller, $Request->method)) {
        $this->invoke($Controller, $Request->method, $Request->args);
      } else {
        $this->invoke($Controller, 'index', null);
      }
    }

    if(DEBUG_MODE)
      $this->printData($requestUri, $Request);
  }

  /*
   * Parses the request uri to an object.
   *
   * @param string Uri to parse.
   * @return object Request instance created from the passe Uri.
   */
  protected function parseUri($requestUri) {
    $requestUri = rtrim($requestUri, '/');
    $requestUri = explode('/', $requestUri);

    $Request = new Request();
		$Request->controller = (isset($requestUri[0]) && isset($requestUri[1])) ?
      $requestUri[0] : 'index';
		$Request->method = (isset($requestUri[1])) ?
      $requestUri[1] : $requestUri[0];
    $Request->method = str_replace("-", "_", $Request->method);
		$Request->args = (isset($requestUri[2])) ?
      $requestUri[2] : null;

    return $Request;
  }

  /*
   * Invokes the passed method on the given controller.
   * In case arguments are specified those will be passed
   * to the invoked method.
   *
   * @param controller Controller to use.
   * @param method Method to invoke.
   * @param args Arguments to pass to the method.
   */
  protected function invoke($Controller, $method, $args) {
		if($args != null) {
      $Controller->{$method}($args);
    } else {
      $Controller->{$method}();
    }
	}

  /*
   * Creates a new instance of the error controller.
   *
   * @return object Instance of error controller.
   */
  protected function createErrorController() {
		require_once PATH_CONTROLLERS_DIR.'error.php';
		return new Error();
	}

  /*
   * Determines wether or not a controller with the given name exists.
   *
   * @param name Name of the controller.
   * @return bool true if the controller exists; false otherwise.
   */
  protected function existsController($name) {
		return file_exists(PATH_CONTROLLERS_DIR.$name.'.php');
	}

  /*
   * Creates a new instance of the controller with the passed name.
   *
   * @param controllerName Name of the controller.
   * @return object Instance of the desired controller.
   */
  protected function createController($controllerName) {
    require_once PATH_CONTROLLERS_DIR.$controllerName.'.php';
    return new $controllerName;
  }

  protected function printData($requestUri, $Request) {
    echo "<p>Request Uri</p>";
    echo "<pre>";
    print_r($requestUri);
    echo "</pre>";

    echo "<p>GET</p>";
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";

    echo "<p>POST</p>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    echo "<p>Request</p>";
    echo "<pre>";
    print_r($Request);
    echo "</pre>";
  }
}
?>
