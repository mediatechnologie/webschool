<?php
class database
{
	protected $db;
	
	function __construct()
	{
		$args  =  func_get_args();
		$this->db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		
		if($this->db->connect_error)
		{
			echo '<p>Oh noes! We could not connect to the database!</p>';
			exit;
		}
		
		if(method_exists($this,'_init'))
			call_user_func_array( array( $this , '_init' ) , $args );
	}
	
	
	function __destruct()
	{
		$this->db->close();
	}
}
?>