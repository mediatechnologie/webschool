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
			'schoolname'		=> 'Mediacollege Amsterdam',
			'url'			=> 'http://localhost/webschool/',
			'title'			=> '',
			'content'		=> '',
			'sidebar'		=> ''
		);

		$menu = array(
			'Homepage'		=>  'dashboard',
			'Roosters'		=>  'schedule',
			'Leerlingen'		=>  'students',
			'Agenda'		=>  'agenda',
			'Webmail'		=>  'mail'
		);


		// Create menu HTML code
		$menu_content = '<ul>';
		
		    foreach ($menu as $page => $link)
		    {
			$parameters = '';

			if($this->type == $link)
			{
			    $parameters = 'class="active"';
			}

			$menu_content .= '<li><a '.$parameters.' href="?type='.$link.'">'.$page.'</a></li>';
		    }
		
		$menu_content .= '</ul>';

		$tags['menu'] = $menu_content;

		
		try
		{
			if(class_exists($this->type))// and class_implements('page', $this->type))
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
}
?>