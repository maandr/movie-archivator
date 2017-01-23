<?php
class User extends Controller
{
	function __construct($userId)
	{
		parent::__construct();
		$this->service = new MovieService($_SESSION['userId']);
	}

	public function index()
	{
		$this->sammlung();
	}
}
?>