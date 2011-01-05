<?php
	class dashboard extends database implements page
	{
		public $title = 'Dashboard';
		
		function title()
		{
			return $this->title;
		}
		
		function content()
		{
			// Dummy content
			$content = '<table><tr><th>#</th><th>Leerlingnummer</th><th>Naam</th><th>Klas</th><th>Al eerder</th><th>Opties</th></tr><tr><td><input name="check" type="checkbox" value="L04572"></td><td>L4242</td><td>Danny Kriger</td><td>M2T</td><td>2x</td><td><img src="img/icons/add.png"></td></tr><tr><td><input name="check" type="checkbox" value="L1337"></td><td>L1337</td><td>Mathijs Bernson</td><td>M2T</td><td>3,5x</td><td><img src="img/icons/add.png"></td></tr><tr><td><input name="check" type="checkbox" value="L4312"></td><td>L4312</td><td>Farid el Nasire</td><td>M2T</td><td>2x</td><td><img src="img/icons/add.png"></td></tr><tr><td><input name="check" type="checkbox" value="L4312"></td><td>L3313</td><td>Johan Vlissingen</td><td>M2T</td><td>2x</td><td><img src="img/icons/add.png"></td></tr></table><p><input name="send" type="button" value="Formulier verzenden"></p>';
			$hoi = new box('Webschool', $content);
			
			return $hoi->getBox().$hoi->getBox();
		}
		
		function boxes()
		{
			// Some more dummy content
			$content = '<form method="post"><p>Naam</p><form method="post"><p><input type="text" size="32" name="search" /> <input type="submit" value="Zoeken" /></p></form>';
			$hoi = new box('Webschool', $content);
			
			return $hoi->getBox().$hoi->getBox();
		}
		
		function warnings()
		{
			$waarschuwing = new box('', 'Zo ziet een foutmelding eruit.');
			
			return $waarschuwing->getWarning('error').$waarschuwing->getWarning('error');
		}
	}
?>