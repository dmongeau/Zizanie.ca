<?php

	require_once PATH_ROOT.'/models/Page.php';
	
	$select = $this->db->select()->from(array('p'=>'pages'),array('*'))
									->order('dateadded DESC')
									->limit(5);
	$pages = $this->db->fetchAll($select);

?>
<div class="left">
    
    <div class="spacer-small"></div>
    
	<p class="mission"><strong>zizanie</strong> est un outil qui vous permet de créer des pages minimalistes<br/>axées sur le partage et l'échange d'idées en toute liberté.</p>
    
    <div class="spacer-small"></div>
    
    <h4>Voici quelques exemples:</h4>
    <div class="spacer-small"></div>
    <ul class="point">
    	<li><a href="http://fabiennelarouche.<?=DOMAIN?>">Des idées pour Fabienne Larouche</a></li>
    	<li><a href="http://chara.<?=DOMAIN?>">Chara - Fuck you NHL</a></li>
    	<li><a href="http://richardmartineau.<?=DOMAIN?>">Richard Martineau est contre...</a></li>
    	<li><a href="http://ericduhaime.<?=DOMAIN?>">Des idées pour enrichir les riches</a></li>
    </ul>
    
    <div class="spacer"></div>
    
    
</div>

<div class="right">
    
    <div class="spacer-small"></div>
    
    <ul class="pages">
    <?php foreach($pages as $page) {
		
			$color = $page['titleColor'];
			$bgcolor = $page['backgroundColor'];
			
			$Page = new Page();
			$Page->setData($page);
		
		?>
    	<li style="<?=$Page->borderColor()?> <?=$Page->background()?> <?=$Page->fontFamily()?>">
        	<a href="http://<?=$page['permalink']?>.<?=DOMAIN?>/" style="<?=$Page->titleColor()?>"><?=$page['title']?></a>
        </li>
    <?php } ?>
    </ul>
    
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