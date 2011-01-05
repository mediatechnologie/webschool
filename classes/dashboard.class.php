<?php
class dashboard implements page
{
	public $title = 'Dashboard';
	
	function title()
	{
		return $this->title;
	}
	
	function content()
	{
		// Dummy content
		$content = '<form method="post"><table>
		<thead>
			<tr>
				<th>#</th>
				<th>Leerlingnummer</th>
				<th>Voornaam</th>
				<th>Achternaam</th>
				<th>Klas</th>
				<th>Al eerder</th>
				<th>Opties</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><input type="checkbox" name="L4242" value="check" /></td>
				<td>L4242</td>
				<td>Danny</td>
				<td>Kriger</td>
				<td>M2T</td>
				<td>2x</td>
				<td><img src="img/icons/add.png"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="L1337" value="check" /></td>
				<td>L1337</td>
				<td>Mathijs</td>
				<td>Bernson</td>
				<td>M2T</td>
				<td>3,5x</td>
				<td><img src="img/icons/add.png"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="L4312" value="check" /></td>
				<td>L4312</td>
				<td>Farid</td>
				<td>el Nasire</td>
				<td>M2T</td>
				<td>2x</td>
				<td><img src="img/icons/add.png"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="L3313" value="check" /></td>
				<td>L3313</td>
				<td>Johan</td>
				<td>Vlissingen</td>
				<td>M2T</td>
				<td>2x</td>
				<td><img src="img/icons/add.png"></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="L7234" value="check" /></td>
				<td>L7234</td>
				<td>Henk</td>
				<td>Ankerman</td>
				<td>M2T</td>
				<td>5x</td>
				<td><img src="img/icons/add.png"></td>
			</tr>
		</tbody>
		</table>
		<p>
		Markeren als: 
		<select name="status">
			<option value="aanwezig">Aanwezig</option>
			<option value="laat">Te laat</option>
			
		</select>
		<input type="submit" value="Toepassen">
		</p></form>';
		
		$studentlist = new box('Leerlingen', $content);
		
		return $studentlist->getBox().$studentlist->getBox();
	}
	
	function boxes()
	{
		// Some more dummy content
		$content = '<form method="post"><p><input type="text" name="search" /> <input type="submit" value="Zoeken" /></p></form>';
		$search = new box('Zoeken', $content);
		
		return $search->getBox().$search->getBox();
	}
	
	function warnings()
	{
		$waarschuwing = new box('Fout', 'Zo ziet een foutmelding eruit.');
		
		return $waarschuwing->getWarning('error').$waarschuwing->getWarning('error');
	}
}
?>