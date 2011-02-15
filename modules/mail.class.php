<?php
class Mail extends database implements page
{
	private $title = 'Webmail';
	private $count_unread;
	private $count_total;

	public function __construct()
	{
		parent::__construct();
	}
	
	public function title()
	{
		return $this->title;
	}

	public function content()
	{
		$messages = $this->fetchMail();
		$unread = 0;
		
		// Maak array zodat indien er geen berichten zijn er geen "array_unique() expects parameter 1 to be array, null given error komt"
		$id_list = array();
		
		foreach($messages as $row => $key)
		{

			// Add to Array which should be changed to names & classes
			$id_list[] = $key['from'];

			// Make Date
			$date = explode(' ', $key['date']);
			$date = explode('-', $date[0]);

			// Mark the unread messages in bold style
			if($key['read'] == 0)
			{
				$attributes = 'class="message-unread"';
				$unread++;
			}

			// Names & Classes
			$from = $this->idToUsername($key['from']);
			$class = $this->idToClass($key['from']);

			$mail_list.='
				<tr '.$attributes.'>
					<td>
					<input name="check" type="checkbox" value="L04572">
					</td>
					<td>'.$from.' ('.$class.')</td>
					<td><img src="img/icons/email_open.png"/></td>
					<td>'.$key['subject'].'</td>
					<td>'.$date[2].'/'.$date[1].'/'.$date[0].'</td>
					<td>
					<img src="img/icons/add.png">
					</td>
				</tr>
			';

			// Bovenkant van table
			$content = '
			<table>
				<thead>
					<tr>
						<th></th>
						<th width="275">Van</th>
						<th width="22"></th>
						<th>Onderwerp</th>
						<th>Datum</th>
						<th>Opties</th>
					</tr>
				</thead>
				<tbody>
					'.$mail_list.'
				</tbody>
			</table>
			
			<p>
			<input name="send" type="button" value="Verwijderen"> <input name="send" type="button" value="Verplaatsen">
			</p>';
		}
		
		$id_list = array_unique($id_list);

		// Geef melding als mensen nog niks in hun email box hebben staan.
		if (count($id_list) == 0)
		{
			$content = '<p>Je hebt (nog) geen berichten in je mailbox.</p>';
		}

			$Inbox = new box('Inbox - Ongelezen berichten ('.$unread.')', $content);
			return $Inbox->getBox();
	}

	public function boxes()
	{
		// Inbox
		$content = '
			<ul>
				<li>Nieuw bericht</li>
				<li>Postvak IN</li>
				<li>Verstuurd</li>
				<li>Verwijderd</li>
			</ul>
		';
		
		$Inbox = new Box('Inbox', $content);

		return $Inbox->getBox();
	}

	public function warnings()
	{
	}

	private function fetchMail($start = 0)
	{
		// Make SQL query
		$sql = "SELECT * FROM `message` WHERE `to` = '".$_SESSION['userid']."' AND `parent` = '0' LIMIT $start, 25";
		$messages = $this->db->query($sql);

		return $messages->fetchAll();
	}
	
	private function idToUsername($id)
	{
		// Make SQL query
		$sql = "SELECT * FROM  `user` WHERE  `id` = '".$id."' LIMIT 0 , 1";
		$results = $this->db->query($sql);
		
		foreach($results as $row)
		{
			$newUsername = $row['firstname'] .' '. $row['lastname'];
		}
		
		return $newUsername;
	}
	
	private function idToClass($id)
	{
		// Make SQL query
		$sql = "SELECT * FROM  `user` WHERE  `id` = '".$id."' LIMIT 0 , 1";
		$results = $this->db->query($sql);
		
		foreach($results as $row)
		{
			$newClass = $row['class'];
			$sql = "SELECT * FROM  `class` WHERE  `id` = '".$newClass."' LIMIT 0 , 1";
			$results = $this->db->query($sql);
		
			foreach($results as $row)
			{
				$newClass = $row['fullname'];
			}
		}
		
		return $newClass;
	}
}
?>