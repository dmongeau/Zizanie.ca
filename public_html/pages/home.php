<?php

	require_once PATH_APP.'/models/Page.php';
	
	$select = $this->db->select()->from(array('p'=>'pages'),array('*'))
									->order('dateadded DESC')
									->limit(5);
	$pages = $this->db->fetchAll($select);

?>
<div class="left">
    
    <div class="spacer-small"></div>
    
	<p class="mission"><strong>zizanie</strong> est un outil qui vous permet de créer des pages minimalistes<br/>axées sur le partage et l'échange d'idées en toute liberté.</p>
    
    <div class="hr"></div>
    
    <h3>Comment ça fonctionne?</h3>
    <ol>
    	<li>Trouvez un sujet</li>
    	<li>Sélectionnez un type de page</li>
    	<li>Personnalisez votre page</li>
    	<li>Partagez avec tout le monde</li>
    </ol>
    <div class="spacer-small"></div>
    <p><a href="/creer/" class="button">Créez une page</a></p>
    
    
</div>

<div class="right">
    
    <div class="spacer-small"></div>
    
    <h3>Dernières pages</h3>
    <ul class="pages">
    <?php foreach($pages as $page) {
		
			$color = $page['titleColor'];
			$bgcolor = $page['backgroundColor'];
			
			$Page = new Page();
			$Page->setData($page);
			
			if($Page->isWebFont()) {
				$this->addStylesheet($Page->getWebFontUrl());
			}
		
		?>
    	<li style="border-color:<?=$Page->borderColor()?>; background:<?=$Page->background()?>; font-family:<?=$Page->fontFamily()?>;">
        	<a href="http://<?=$page['permalink']?>.<?=DOMAIN?>/" style="color:<?=$Page->titleColor()?>;"><?=$page['title']?></a>
        </li>
    <?php } ?>
    </ul>
    
</div>