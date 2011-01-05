<?php
/*
Template class
Finds and replaces template-tags such as {name} in a file.
*/
class template
{
	public $tags;
	public $content;
	
	function __construct($file, $tags)
	{
		if(is_array($tags))
		{
			$this->tags = $tags;
		}
		
		if(file_exists($file))	
		{
			$this->content = file_get_contents($file);
		}
	}
	
	function parse()
	{
		foreach($this->tags as $key=>$tag)
		{
			$this->content = str_replace('{'.$key.'}', $tag, $this->content);
		}			
	}

	function output()
	{
		return $this->content;
	}
}
?>