<?php

/**
 * class.database.php
 * Version 1.0
 * 
 */


class Database
{
	/**
	 * Database connection
	 */

	/**
	 * VARIABLES
	 */
	private static $_connection = NULL;


	/**
	 * METHODS
	 */


	/**
	 * Constructor to prevent anything outside the class instantiating
	 * a DB connection.
	 */
	private function __construct()
	{
	}
	

	/**
	 * As we've made the class private, we need to make a public getter 
	 * in order to access it from the web app.
	 */
	public static function getConnection() 
	{
		// if there is no connection open, create one
		if (!self::$_connection) 
		{
			try
			{
				$options = array(
					PDO::ATTR_PERSISTENT => true, 
					PDO::ATTR_EMULATE_PREPARES => false, 
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
				);
				self::$_connection = new PDO(DSN, DB_USER, DB_PASSWORD, $options);
			}
			catch (PDOException $error) 
			{
				print "Error!: " . $error->getMessage() . "<br/>";
				die();
			}
		}
		return self::$_connection;
	}



}

?>