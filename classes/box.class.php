<?php
/**
 * Structure for a box in the Webschool interface
 */
class box
{
	public $title;
	public $content;
	
	function __construct($title, $content)
	{
		$this->title = $title;
		$this->content = $content;
	}
	
	/**
	 * Return the output for the box
	 * 
	 * @access public
	 * @return void
	 */
	function getBox()
	{
		$tags = array(
			'title' => $this->title,
			'content' => $this->content
		);
		
		$box = new template('html/box.html', $tags);
		$box->parse();
		return $box->output();
	}
	
	/**
	 * Return the output for the box as a warning
	 * 
	 * @access public
	 * @param mixed $kind
	 * @return void
	 */
	function getWarning($kind)
	{
		$types = array('success', 'error', 'notice', 'warning');
		
		if(!in_array($kind, $types))
		{
			$kind = 'notice';
		}
		
		/**
		 * @todo Tidy this up for a bit
		 */
		$this->content = str_replace('<p>', '', $this->content);
		$this->content = str_replace('</p>', '', $this->content);
		
		$tags = array(
			'content' => $this->content,
			'kind' => $kind
		);
		
		$box = new template('html/warning.html', $tags);
		$box->parse();
		return $box->output();
	}
}
?>