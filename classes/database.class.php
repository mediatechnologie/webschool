<?php
/**
 * Abstract database class.
 * 
 * @abstract
 */
abstract class database
{
	protected $db;
	
	function __construct()
	{
		try
		{
			$this->db = new pdo('mysql:host='.DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
		}
		catch(Exception $error)
		{
			echo $error->getMessage();
		}
	}
	
	
	function __destruct()
	{
		$this->db = null;
	}
}
?>