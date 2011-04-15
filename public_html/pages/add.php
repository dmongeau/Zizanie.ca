<?php



if($_POST) {
	
	$config = include 'config.php';
	
	$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
	$client = Zend_Gdata_ClientLogin::getHttpClient('info@greghoraire.org', 'temp1234', $service);
	$service = new Zend_Gdata_Calendar($client);
	
}

?><h1>Ajouter un événement</h1>

<form action="?" method="post">

<p><label>Titre :</label><br/>
<input type="text" name="title" /></p>

<p><label>Description :</label><br/>
<textarea name="description"></textarea></p>

<p><button type="submit">Ajouter</button></p>

</form>