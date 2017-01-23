<?php
class Autoloader {

	private $directories;

	/* constructor */
	function __construct() {
		$this->directories = array();
	}

	/*
	 * Adds the passed path to the list of pathes to scan for .php files.
	 *
	 * @param path Path to observe for .php-files.
	 */
	public function observe($path) {
		array_push($this->directories, $path);
	}

	/*
	 * Loads the .php-files for the passed class by scanning
	 * all observed directories for it.
	 *
	 * @param className Class to load.
	 */
	public function load($className) {
		foreach($this->directories as $directory) {

			$filePath = $directory.sprintf("%s.php", $className);

			if(file_exists($filePath)) {
				require_once $filePath;
			}
		}
	}
}
?>
