<?php
session_start();
try {
	require_once 'app/scripts/init_config_files.php';
	require_once 'autoloader.php';

	$getRequest = (isset($_GET['url'])) ? $_GET['url'] : '';

	$RequestRouter = new RequestRouter();
	$RequestRouter->handleRequest($getRequest);
} catch(Exception $e) {
	echo $e->getMessage();
}
?>
