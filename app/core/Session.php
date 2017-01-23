<?php

class Session extends SessionHandler

{

    private $key;

    private $name;

    private $cookie;

    

    // creates a new sesstion instance

    public function __construct($key, $name = 'MY_SESSION', $cookie = array())

    {

        $this->key = $key;

        $this->name = $name;

        $this->cookie = $cookie;

        

        $this->cookie = array(

                'lifetime' => 0,

                'path' => ini_get('session.cookie_path'),

                'domain' => ini_get('session.cookie_domain'),

                'secure' => isset($_SERVER['HTTPS']),

                'httponly' => true

        );

        

        $this->setup();

    }



    // initializes the session enviroment

    public function setup()

    {

        ini_set('session.use_cookies', 1);

        ini_set('session.use_only_cookies', 1);

        

        session_name($this->name);

        

        session_set_cookie_params(

                $this->cookie['lifetime'], 

                $this->cookie['path'],

                $this->cookie['domain'], 

                $this->cookie['secure'],

                $this->cookie['httponly']

        );

        

        ini_set('session.save_handler', 'files');

        session_set_save_handler($this, true);

    }

    

    // starts a new session

    public function start()

    {

        if(session_id() === '')

        {
	    $session_id = uniqid("sess");
            if(session_start($session_id))

            {

                return (mt_rand(0, 4) === 0) ? $this->refresh() : true;

            }

        }

        

        return false;

    }

    

    // destroyes a session

    public function forget()

    {

        if(session_id() === '') 

            return false;

        

        unset($_SESSION);

        

        setcookie(

                $this->name, 

                '', 

                time() - 42000,

                $this->cookie['path'], 

                $this->cookie['domain'],

                $this->cookie['secure'], 

                $this->cookie['httponly']

        );

        
        return session_destroy();

    }

    

    // refreshes the session id

    public function refresh()

    {

        return session_regenerate_id(true);

    }

    

    // read from the session (decrypt)

    public function read($id)

    {

        return mcrypt_decrypt(MCRYPT_3DES, $this->key, parent::read($id), MCRYPT_MODE_ECB);

    }

    

    // wirtes to the session (encrypt)

    public function write($id, $data)

    {

        return parent::write($id, mcrypt_encrypt(MCRYPT_3DES, $this->key, $data, MCRYPT_MODE_ECB));

    }

    

    // specifies if the session is expired or not

    public function isExpired($ttl = 30)

    {

        $activity = isset($_SESSION['_last_activity']) ? $_SESSION['_last_activity'] : false;

        

        if($activity !== false && time() - $activity > $ttl * 60)

        {

            return true;

        }

        

        $_SESSION['_last_activity'] = time();

        

        return false;

    }

    

    // fingerprints the session

    public function isFingerprint()

    {

        $hash = md5(

                $_SERVER['HTTP_USER_AGENT'] .

                (ip2long($_SERVER['REMOTE_ADDR']) % ip2long('255.255.0.0'))

        );

        

        if(isset($_SESSION['_fingerprint']))

        {

            return $_SESSION['_fingerprint'] === $hash;

        }

        

        $_SESSION['_fingerprint'] = $hash;

        

        return true;

    }

    

    // specifies it the session is expired and is fingerprinted

    public function isValid($ttl = 30)

    {

        return ! $this->isExpired($ttl) && $this->isFingerprint();

    }

}

?>

