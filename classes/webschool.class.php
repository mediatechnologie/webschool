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
		}
	}
	
	/**
	 * Generate webschool 
	 * @access public
	 * @return void
	 */
	public function invoke()
	{
		$tags = array(
			'name' 			=> 'Webschool',
			'schoolname'	=> 'Mediacollege Amsterdam',
			'url'			=> 'http://localhost/webschool/',
			'menu'			=> $this->menu()
		);

		try
		{
			/**
			 * @todo Check whether the class is an implementation of the interface page
			*/
			if(class_exists($this->type))
			{
				$page = new $this->type;
				
				$tags['title'] 		= $page->title();
				$tags['content'] 	= $page->content();
				$tags['sidebar'] 	= $page->warnings().$page->boxes();
			}
		}
		catch(Exception $exception)
		{
			$tags['title'] = 'Pagina niet gevonden!';
			$tags['content'] = '<p>De pagina die je hebt opgevraagd bestaat niet.</p>';
		}
		
		$layout = new template('html/webschool.html', $tags);
		$layout->parse();
		return $layout->output();
	}
	
	/**
	 * Generate the menu, output an unordered list
	 * @access protected
	 * @return void
	 */
	protected function menu()
	{
		$menu = array(
			'Homepage'		=>  'dashboard',
			'Roosters'		=>  'schedule',
			'Leerlingen'	=>  'students',
			'Agenda'		=>  'calendar',
			'Webmail'		=>  'mail'
		);

		// Create menu HTML code
	    foreach ($menu as $page => $link)
	    {
			$parameters = '';
			if($this->type == $link)
			{
			    $parameters = 'class="active"';
			}
			
			$menu_content .= '<li><a '.$parameters.' href="?type='.$link.'">'.$page.'</a></li>';
	    }

		return '<ul>'.$menu_content.'</ul>';	
	}
}
?>