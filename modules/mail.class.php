<?php
	class mail extends database implements page
	{
		public $title = 'Webmail';
		
		function title()
		{
			return $this->title;
		}
		
		function content()
		{
			// Dummy content
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
				<tr class="message-unread">
					<td>
					<input name="check" type="checkbox" value="L04572">
					</td>
					<td>Danny Kriger (MT2A)</td>
					<td><img src="img/icons/email.png"/></td>
					<td>Begin Webschool</td>
					<td>05/01/2011</td>
					<td>
					<img src="img/icons/add.png">
					</td>
				</tr>
				<tr>
					<td>
					<input name="check" type="checkbox" value="L04572">
					</td>
					<td>Danny Kriger (MT2A)</td>
					<td><img src="img/icons/email_open.png"/></td>
					<td>Begin Webschool</td>
					<td>05/01/2011</td>
					<td>
					<img src="img/icons/add.png">
					</td>
				</tr>
				<tr>
					<td>
					<input name="check" type="checkbox" value="L04572">
					</td>
					<td>Danny Kriger (MT2A)</td>
					<td><img src="img/icons/email_open.png"/></td>
					<td>Begin Webschool</td>
					<td>05/01/2011</td>
					<td>
					<img src="img/icons/add.png">
					</td>
				</tr>
			</tbody>
			</table>
			<p>
			<input name="send" type="button" value="Formulier verzenden">
			</p>';
			$Inbox = new box('Inbox', $content);
			
			return $Inbox->getBox();
		}
		
		function boxes()
		{
			// Some more dummy content
			$content = '<form method="post"><p>Naam</p><form method="post"><p><input type="text" size="32" name="search" /> <input type="submit" value="Zoeken" /></p></form>';
			$hoi = new box('Webschool', $content);
			
			return $hoi->getBox();
		}
		
		function warnings()
		{
		    /*
			$waarschuwing = new box('', 'Hier komt Webmail!');
			
			return $waarschuwing->getWarning('error');
		     *
		     */
		}
	}
?>