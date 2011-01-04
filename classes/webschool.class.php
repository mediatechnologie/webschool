<?php
/**
 * webschool class.
 * Generic class that generates the site
 */
class webschool
{
	
	public $type = 'dashboard';
	
	function __construct()
	{
		if(!empty($_GET['type']))
		{
			$this->type = $_GET['type'];
			htmlentities($this->type);
			stripslashes($this->type);
		}
	}
	
	/**
	 * invoke function.
	 * Generate webschool 
	 *
	 * @access public
	 * @return void
	 */
	public function invoke()
	{
		$tags = array(
			'name' 			=> 'Webschool',
			'schoolname'	=> 'Mediacollege Amsterdam',
			'url'			=> 'http://localhost/webschool/',
			'title'			=> 'Niet gevonden',
			'content'		=> '<p>Oh noes, pagina niet gevonden!</p>',
			'sidebar'		=> ''
		);
		
		try {
		if(class_exists($this->type))// and class_implements('page', $this->type))
		{
			$page = new $this->type;
			
			$tags['title'] 		= $page->title();
			$tags['content'] 	= $page->content();
			$tags['sidebar'] 	= $page->warnings().$page->boxes();
		}
		}
		catch(Exception $exception)
		{}
		
		$layout = new template('html/webschool.html', $tags);
		$layout->parse();
		return $layout->output();
	}
}
?>