<?php
session_start();
try {
	require_once 'app/scripts/init_config_files.php';
	require_once 'autoloader.php';

	$Router = new Router();
	$Router->processRequest();

} catch(Exception $e) {
	echo $e->getMessage();
}
?>
