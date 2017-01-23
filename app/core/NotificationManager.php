<?php
class NotificationManager
{
	// singleton instance
	public static $instance = null;
	
	private $warnings;
	private $errors;
	private $infos;
	
	public static function getInstance()
	{
		if(!isset(self::$instance))
		{
			self::$instance = new NotificationManager();
		}
		return self::$instance;
	}
	
	function __construct()
	{
		$this->warnings = array();
		$this->errors = array();
		$this->infos = array();
	}
	
	public function Warning($message)
	{
		array_push($this->warnings, $message);
	}
	
	public function Error($message)
	{
		array_push($this->errors, $message);
	}
	
	public function Info($message)
	{
		array_push($this->infos, $message);
	}
	
	public function getErrors()
	{
		return $this->errors;
	}
	
	public function getInfos()
	{
		return $this->infos;
	}
	
	public function getWarnings()
	{
		return $this->warnings;
	}
}
?>