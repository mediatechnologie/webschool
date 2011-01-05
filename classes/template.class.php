<?php
/**
 * Replace template tags such as {title}
 * @author duck
 * @version 1.0
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

	public function output()
	{
		return $this->content;
	}
}
?>