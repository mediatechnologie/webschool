<?php
class user extends database
{
	protected $ses = $_SESSION;
	public $username;
	private $password;
	
	function _init()
	{
		if(!empty($this->ses['username']))
	}
	
	function login()
	{
		session_start();
		$_SESSION['user_id'] = $this->user_id;
	}
	
	function logout()
	{
		session_destroy();
	}
}
?>
