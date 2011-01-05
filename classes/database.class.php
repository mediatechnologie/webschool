<?php
/**
 * Handles a connection to a database.
 *
 * @abstract
 */
abstract class database
{
	protected $db;
	
	/**
	 * @todo Turn this thing into a proper database class
	 */
	function __construct()
	{
		try
		{
			$this->db = new pdo('mysql:host='.DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
		}
		catch(Exception $error)
		{
			echo 'Could not connect to the database.';
			
			exit;
		}
	}
	
	
	function __destruct()
	{
		$this->db = null;
	}
}
?>