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
		$action = $_GET['action'];
		if($action == 'write')
		{
			return $this->writeEmail();
		}
		else {
			return $this->showMailbox();
		}
	}
	
	private function showMailbox()
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
			
			return $content;
	}

	private function writeEmail()
	{
		
		if(isset($_POST['aan']))
		{
			$to = $_POST['aan'];
			$onderwerp = $_POST['onderwerp'];
			$bericht = $_POST['bericht'];
			
			//Explode alle 
			$to = explode(',', $to);
		}		
		$content =
		'
		<form method="post" action="index.php?type=mail&action=write">
			<div id="write">
				<ul>
				    <li>
					<div class="title">Aan:</div>
				    </li>
				    <li>
					<textarea rows="2" cols="20" class="to" id="aan" name="aan" type="textfield"></textarea>
				    </li>
				    <li>
					<div class="title">Onderwerp:</div>
				    </li>
				    <li>
					<input id="onderwerp" name="onderwerp" type="text">
				    </li>
				    <li>
					<div class="title">Bericht:</div>
				    </li>
				    <li>
					<textarea rows="2" cols="20" class="mail" id="bericht" name="bericht" type="textfield"></textarea>
				    </li>
				</ul>
			</div>
			<p>
				<input name="send" type="button" value="Verzenden"> <input name="send" type="button" value="Opslaan"> <input name="send" type="button" value="Verwijderen">
			</p>
		</form>';

		$Inbox = new box('Nieuw bericht', $content);
		return $Inbox->getBox();
			
		return $content;
	}

	public function boxes()
	{
		// Inbox
		$content = '
			<ul>
				<li><a href="index.php?type=mail&action=write">Nieuw bericht</a></li>
				<li><a href="index.php?type=mail">Postvak IN</a></li>
				<li><a href="#">Verstuurd</a></li>
				<li><a href="#">Verwijderd</a></li>
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
		// Maakt van een idnummer dat dat in de database staat bij een mail een voornaam en achternaam
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
		// Maakt van een idnummer dat dat in de database staat bij een mail een klasnaam
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