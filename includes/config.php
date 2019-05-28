<?php 
	/* database connection */
	ob_start();
	@session_start();
	error_reporting(1);
	error_reporting(E_ALL ^ E_NOTICE);


	define('HOST','localhost'); 
	define('USER','root');
	define('PWD','');
	define('DATA','php_library');
	define('connector','mysqli'); //mysql

	$today	= date('Y-m-d H:i:s');
	$today_date	= date('Y-m-d');
	$today_time	= date('H:i:s');

	
	include('connection_class.php');

	$config = new config(HOST, USER, PWD, DATA,'' , connector);
	$my_db = new ConnectionDB($config);

	// We can now open the connection to the database.
	$my_db->openConnection();

	// If your config details are right, we are now connected to a database, lets test the connection before we run queries.
	$are_we_online = $my_db->pingServer();

	// The variable $are_we_online should be true (or 1) if we are connected to the server.
	// prints 0 or 1.
	
	
	define('DB_CHARSET', 'utf8');
	define('DB_COLLATE', '');

    $global_message = "";

    /*
    |--------------------------------------------------------------------------
    | Ip Address
    |--------------------------------------------------------------------------
    */
    function getIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    $currentOpenFileName = basename($_SERVER['SCRIPT_FILENAME']);
?>