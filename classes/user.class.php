<?php
/**
 * Handle user data and session data
 * 
 * @extends database
 */
class user extends database
{
	public $username;
	private $password;
	
	public function __construct()
	{
		parent::__construct();
		
		if(empty($_SESSION['username']))
		{
			$this->verify($_POST['username'], $_POST['password']);
		}
		
		// Uitloggen 
		if($_GET['do'] == 'logout')
		{
			$this->logout();
		}
		
		
		if ($_GET['error'] == 'login')
		{
			// Tijdelijke error voor als de gebruikersnaam of wachtwoord niet correct is.
			echo '
			<div id="error">
				Jouw gebruikersnaam of wachtwoord is niet correct.
			</div>			
			';
		}
	}
	
	private function verify($username, $password)
	{
		if($_POST['do'] == 'login')
		{
			// Username ophalen en beveiligen
			$username = $_POST['username'];
				$username = stripslashes($username);
			// Password ophalen en beveiligen
			$password = md5($_POST['password']);
				$password = stripslashes($password);
				
			// SQL uitvoeren om te controleren of een gebruiker bestaat.
			$sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
			$stmt = $this->db->query($sql);
			$result = $stmt->rowCount();

			if($result == 1)
			{
				// Indien de gebruiker de goede gegevens heeft ingevuld dan worden de gegevens als sessie opgeslagen.
				$result = $stmt->fetch();
				$_SESSION['username'] = $result['username'];
				$_SESSION['firstname'] = $result['firstname'];
				$_SESSION['lastname'] = $result['lastname'];
				header('location: index.php');
			}
			elseif($result == 0)
			{
				// Indien de gebruiker verkeerde gegevens heeft ingevoerd word hij/zij naar deze pagina doorgestuurd.
				header('location: index.php?error=login');
			}
		}
	}
	
	function login()
	{
		// Start session
		session_start();
		$_SESSION['user_id'] = $this->user_id;
	}
	
	function logout()
	{
		// Loguit dmv Session Destroy.
		session_destroy();
		header('location: index.php');
	}
}
?>