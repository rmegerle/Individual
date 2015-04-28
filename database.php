<?php

// filename: database.php,Rick Megerle, cis355, 

	session_start();
	if ($_SESSION["id"] != "loggedIn")
		header("Location: login.php");

class Database 
{
	private static $dbName = 'CIS355rtmegerl' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'CIS355rtmegerl';
	private static $dbUserPassword = 'cis355';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>