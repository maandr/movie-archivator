<?php
class LoginModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function install()
    {
    	$sql = file_get_contents('models/install/login_attempts.sql');
    	$this->Database->query($sql);
    	
    	echo "success!";
    }
    
    public function login($data)
    {
        $result = $this->Database->select("SELECT id, password, role FROM user WHERE username = :username", array('username' => $data['username']));
        $result = $result[0];

        // security lock for brute force attacks
        $attempts = $this->Database->select("SELECT COUNT(id) AS count FROM login_attempts WHERE id = :id AND time >= DATE_SUB(NOW(), INTERVAL 1 HOUR)", array('id' => $result['id']));
        
        if(isset($attempts['count']) && $attempts['count'] > LOCK_AFTER_LOGIN_ATTEMPTS)
        {
            return -1;
        }
        
        // login incorrect
        if(count($result) == 0)
        {
        	return -2;
        }

        if(Hash::isValid($data['password'], $result['password']))
        {
            return $result;
        }
        else
        {
            $this->Database->insert('login_attempts', array('id' => $result['id']));
            return -2;
        }
    }
}
?>
