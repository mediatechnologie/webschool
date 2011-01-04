<?php
class box
{
	public $title;
	public $content;
	
	function __construct($title, $content)
	{
		$this->title = $title;
		$this->content = $content;
	}
	
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
	
	function getWarning($kind)
	{
		$types = array('success', 'error', 'notice', 'warning');
		
		if(!in_array($kind, $types))
		{
			$kind = 'notice';
		}
		
		// Dit kan wat netter
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