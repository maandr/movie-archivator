<?php
class UserService extends Service
{
	public function __construct()
	{
		parent::__construct(UserFactory::getInstance(), new UserDbTable());
	}
}
?>