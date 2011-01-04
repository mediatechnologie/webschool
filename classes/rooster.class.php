<?php
class rooster
{
	private $username;
	private $password;
	
	function __construct($name, $pass)
	{
		$this->username = $name;
		$this->password = $pass;
	}
	
	function get()
	{
		$prefix = 'https://www.ma-net.nl/_layouts/roosters/MIG/MT/'; 
		$link = $prefix . 'index.htm'; 
		$var = 'wget --user=' . $this->username . ' --no-check-certificate -O - ' . 
		$link . ' --password=' . $this->password; 
		// met back-tics voer je een commando uit op de cli/prompt 
		$var = `$var`; 
		preg_match( '/<a href=".\/([^"]*)">/' , $var , $matches ); 
		$link = $prefix . $matches[ 1 ]; 
		$prefix = dirname( $link ) . '/'; 
		$var = 'wget --user=' . $this->username . ' --no-check-certificate -O - ' . 
		$link . ' --password=' . $this->password; 
		$var = `$var`; 
		preg_match( '/<a href="(.*)">MT2A<\/a>/' , $var , $matches ); 
		$link = $prefix . $matches[ 1 ]; 
		$var = 'wget --user=' . $this->username . ' --no-check-certificate -O - ' . 
		$link . ' --password=' . $this->password; 
		#echo( substr( $var , 0 , -16 ) . 'ask-password' );/** 
		$var = `$var`; 
		preg_match( '/<a href="(.*)">MT2A<\/a>/' , $var , $matches );
		
		return $var;  
	}
}
?>