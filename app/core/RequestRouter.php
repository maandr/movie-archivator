<?php
class RequestRouter
{

	function __construct() {}

	public function handleRequest($requestUrl)
	{
		$Request = $this->createRequest($requestUrl);

		try
		{
			$this->proccessRequest($Request);
		}
		catch(ControllerDoesNotExistException $e)
		{
			$controller = $this->loadErrorController();
			$controller->index();
		}
		catch(NoControllerNameException $e)
		{
			$controller = $this->loadDefaultController();
			$controller->index();
		}
	}

	private function createRequest($url)
	{
		if(!isset($url))
		{
			throw new InvalidArgumentException("Bad Request");
		}

		$requestUrl = $url;
		$requestUrl = rtrim($requestUrl, '/');
		$requestUrl = explode('/', $requestUrl);

		$Request = new Request();
		$Request->controller = (isset($requestUrl[0])) ? $requestUrl[0] : null;
		$Request->method = (isset($requestUrl[1])) ? $requestUrl[1] : null;
		$Request->args = (isset($requestUrl[2])) ? $requestUrl[2] : null;

		return $Request;
	}

	private function proccessRequest($Request)
	{
		$controllerName = $Request->controller;
		$methodName = $Request->method;
		$methodName = str_replace("-", "_", $methodName);
		$requestArgs = $Request->args;

		if($controllerName == null)
		{
			throw new NoControllerNameException();
		}

		$indexController = $this->loadDefaultController();

		if(!$this->existsController($controllerName) && !method_exists($indexController, $controllerName))
		{
			throw new ControllerDoesNotExistException();
		}

		if(method_exists($indexController, $controllerName))
		{
			$this->invoke($indexController, $controllerName, null);
			return;
		}

		$controller = $this->loadController($controllerName);
		if($methodName == null || !method_exists($controller, $methodName))
		{
			$controller->index();
		}
		else
		{
			$this->invoke($controller, $methodName, $requestArgs);
		}
	}

	private function invoke($controller, $method, $args)
	{
		if($args != null)
		{
			$controller->{$method}($args);
		}
		else
		{
			$controller->{$method}();
		}
	}

	private function existsController($name)
	{
		$controllerFile = $this->getControllerFile($name);
		return file_exists($controllerFile);
	}

	private function getControllerFile($name)
	{
		return PATH_CONTROLLERS_DIR.$name.'.php';
	}

	private function loadDefaultController()
	{
		require $this->getControllerFile('index');
		$controller = new Index();
		return $controller;
	}

	private function loadErrorController()
	{
		require $this->getControllerFile('error');
		$controller = new Error();
		return $controller;
	}

	private function loadController($name)
	{
		require $this->getControllerFile($name);
		$controller = new $name;
		return $controller;
	}
}

class ControllerDoesNotExistException extends Exception {}
class NoControllerNameException extends Exception {}
?>
