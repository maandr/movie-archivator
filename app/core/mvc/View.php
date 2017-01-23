<?php
class View {

	private $smarty;

	function __construct() {
		$this->smarty = new Smarty();
		$this->smarty->template_dir = PATH_VIEWS_DIR;
		$this->smarty->compile_dir = TEMPLATE_COMPILE_DIR;
	}

	public function assignArray($array) {
		if(!is_array($array)) {
			throw new InvalidArgumentException('The passed parameter is expected to be an array.');
		}

		foreach($array as $key => $value) {
			$this->assign($key, $value);
		}
	}

	public function assign($key, $value) {
		$this->smarty->assign($key, $value);
	}

	public function render($view) {
		$viewFile = PATH_VIEWS_DIR.$view;

		if(!file_exists($viewFile)) {
			throw new Exception('The desired tempalte file '.$viewFile.' was not found.');
		}

		$this->smarty->display(PATH_VIEWS_DIR.$view);
	}
}
?>
