<?php
/**
 * file class.
 *
 * @deprecated
 * @extends database
 * @implements page
 */
class file extends database implements page
{
	public $title = 'Bestanden';
	
	function title()
	{
		return $this->title;
	}
	
	function filelist()
	{
		$sql = "SELECT * FROM directories WHERE owner = '".$userid."' AND parent = '".$dir."' ORDER BY name ASC";
		$query = $this->db->query($sql);
	}
	
	function content()
	{
		$content = '<p>Welkom bij Webschool</p>';
		$hoi = new box('Webschool', $content);
		
		return $hoi->getBox();
	}
	
	function boxes()
	{
		$content = '<p>Hoi</p>';
		$hoi = new box('Webschool', $content);
		
		return $hoi->getBox();
	}
	
	function warnings()
	{
		return null;
	}
}
?>