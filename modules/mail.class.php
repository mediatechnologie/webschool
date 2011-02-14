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
		foreach($messages as $row => $key)
		{

			// Add to Array which should be changed to names & classes
			$id_list[] = $key['from'];

			// Make Date
			$date = explode(' ', $key['date']);
			$date = explode('-', $date[0]);

			// Mark the unread messages
			if($key['read'] == 0)
			{
				$attributes = 'class="message-unread"';
				$unread++;
			}

			// Names & Classes
			$from = $key['from'];
			$class = $key['from'];

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


			$content = '<table>
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
			<input name="send" type="button" value="Formulier verzenden">
			</p>';

		}

			$id_list = array_unique($id_list);
			//print_r($id_list);
			$Inbox = new Box('Messages', $content);
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
}
?>