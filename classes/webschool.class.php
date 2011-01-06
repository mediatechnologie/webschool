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
			if(!class_exists($this->type))
				throw new Exception($exception);
			
			if($this->type instanceof page)
				throw new Exception($exception);
			
			$page = new $this->type;
			
			$tags['title'] 		= $page->title();
			$tags['content'] 	= $page->content();
			$tags['sidebar'] 	= $page->warnings().$page->boxes();
			
		}
		catch(Exception $exception)
		{
			$error = new box('Fout', $exception->getMessage());
			$tags['title'] = 'Pagina niet gevonden!';
			$tags['content'] = '<p>De pagina die je hebt opgevraagd bestaat niet.</p>';
			$tags['sidebar'] = $error->getWarning('error');
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
			'Homepage' => 'dashboard',
			'Roosters' => 'schedule',
			'Leerlingen' => 'students',
			'Agenda' => 'calendar',
			'Resultaten' => 'grades',
			'Bestanden' => 'files',
			'Portfolio' => 'portfolio',
			'Webmail' => 'mail'
		);

		// Create menu HTML code
		$menu_content = '';
		foreach ($menu as $page => $link)
		{
			$parameters = '';
			if($this->type == $link)
			{
				$parameters = 'class="active" ';
			}
			
			$menu_content .= '<li><a '.$parameters.'href="?type='.$link.'">'.$page.'</a></li>'."\n";
		}

		return '<ul>'.$menu_content.'</ul>';	
	}
}
?>