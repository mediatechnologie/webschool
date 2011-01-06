<?php
/**
 * Generic page class
 *
 * @author mathijs
 * @extends database
 */
class page extends database
{
	public $title;
	public $content;
	
	public $warnings;
	public $boxes;
	
	function title()
	{
		return $this->title;
	}
	
	function content()
	{
		return $this->content;
	}
	
	function warnings()
	{
		return $this->warnings;
	}
	
	function boxes();
	{
		return $this->boxes;
	}
}
?>
