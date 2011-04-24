<?php

require PATH_APP.'/lib/recaptchalib.php';
require PATH_APP.'/models/Page.php';


if($_POST) {
	try {
		
		if(!isset($_POST['title']) || empty($_POST['title'])) {
			throw new Exception('Vous devez entrer un titre pour la page');
		}
		
		$Page = new Page();
		$Page->setData(array_merge($_POST,array(
			'published' => 1
		)));
		$Page->save();
		$page = $Page->fetch();
		
		
	} catch(Exception $e) {
		$error = $e->getMessage();
	}
}


$this->addStylesheet('/statics/css/jqueryui.css');
$this->addStylesheet('/statics/css/colorpicker.css');
$this->addStylesheet('/statics/css/create.css');
$this->addScript('/statics/js/jqueryui.js');
$this->addScript('/statics/js/colorpicker.js');
$this->addScript('/statics/js/upload.js');
$this->addScript('/statics/js/create.js');


?>

<h1>Créer une page</h1>
  
<div class="spacer-small"></div>
        
<form action="?" method="post">
        
   <h2>1. Information de base</h2>
        

	<div class="left">
        
        <?php if(isset($error) && !empty($error)) { ?>
        <div class="error"><?=$error?></div>
        <?php } ?>
        <div class="spacer-small"></div>
        
        <div class="field">
            <label>Titre :</label>
            <div class="input"><input type="text" name="title" class="text title" /></div>
        </div>
        
        <div class="field">
            <label>Choisir une adresse :</label>
            <div class="input">http://<input type="text" name="permalink" class="text address" maxlength="30" />&nbsp;.zizanie.ca</div>
        </div>
        
        <div class="hr"></div>
        
        <div class="field nomargin">
            <label>Type de page :</label>
            <div class="input">
                <label><input type="radio" name="type" value="comments" /> Commentaires</label>
            </div>
            <div class="input">
                <label><input type="radio" name="type" value="battle" /> Commentaires (Pour/Contre)</label>
            </div>
            <div class="input">
                <label><input type="radio" name="type" value="tweet" /> Écrivez la suite...</label>
            </div>
        </div>
        
    </div>
    
    <div class="right">
            
        
        <h3>Comment ça fonctionne?</h3>
        <ol>
            <li>Trouvez un sujet</li>
            <li>Sélectionnez un type de page</li>
            <li>Personnalisez votre page</li>
            <li>Partagez avec tout le monde</li>
        </ol>
        
        <div class="spacer-small"></div>
        
        <h3>Quel type de page choisir?</h3>
       <p>Si vous souhaitez que les visiteurs réagissent à votre sujet à l'aide de commentaires, sélectionnez le type de page <strong>«Commentaires»</strong>.</p>
       <p>Si vous choisissez le type <strong>«Commentaires (Pour/Contre)»</strong>, la page sera séparées en 2 colonnes selon que vous soyez pour ou contre le sujet.</p>
       <p>Le type <strong>«Écrivez la suite...»</strong>, quant à lui, laisse le visiteur compléter votre sujet et l'envoyer sur Twitter.</p>
        
        
    </div>
    
    <div class="clear"></div>
        
    <div class="hr"></div>
    
    <h2>2. Personnalisez votre page</h2>
    
    <div class="spacer-small"></div>
    
    <div class="customize">
        
        <div class="fleft" style="width:400px;">
            <div class="field">
                <label>Police :</label>
                <div class="input" style="width:200px;">
                    <select name="fontFamily">
                    	<optgroup label="Polices systèmes">
                       	<?php
                        
						ksort(Page::$systemFonts);
						
						foreach(Page::$systemFonts as $key => $font) { ?>
                            <option value="<?=$key?>" <?=SEL($key,NEC($_POST,'fontFamily','georgia'),'string')?> rel="<?=$font['fontFamily']?>"><?=$font['name']?></option>
                        <?php } ?>
                        </optgroup>
                    	<optgroup label="Polices web">
                       	<?php
                        
						ksort(Page::$webFonts);
						
						foreach(Page::$webFonts as $key => $font) { ?>
                            <option value="<?=$key?>" <?=SEL($key,NEC($_POST,'fontFamily'),'string')?> rel="<?=$font['fontFamily']?>"><?=$font['name']?></option>
                        <?php } ?>
                        </optgroup>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="field">
                <label>Alignement du titre :</label>
                <div class="input" style="width:200px;">
                    <select name="titleAlign">
                    	<option value="center" <?=SEL('center',NEC($_POST,'titleAlign','center'),'string')?>>Centre</option>
                    	<option value="left" <?=SEL('left',NEC($_POST,'titleAlign','center'),'string')?>>Gauche</option>
                    	<option value="right" <?=SEL('right',NEC($_POST,'titleAlign','center'),'string')?>>Droite</option>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="field">
                <label>Taille du titre :</label>
                <div class="input mt5" style="width:225px;">
                    <input type="hidden" name="titleSize" value="<?=NE($_POST,'titleSize',36)?>" />
                    <div class="fleft" style="width:175px;">
                    	<div class="sizeSlider"></div>
                    </div>
                    <div class="titleSize fleft" style="width:50px; position:relative; top:-7px; left:15px;">
                    </div>
                	<div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="field">
                <label>Couleur du titre :</label>
                <div class="input" style="width:200px;">
                    <input type="text" name="titleColor" class="text color" value="<?=NE($_POST,'titleColor','#333333')?>" />
                    <span class="color"></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    
        <div class="fleft" style="width:500px;">
            <div class="field">
                <label>Image de fond :</label>
                <div class="input">
                    <input type="file" name="backgroundImage" class="file" />
                </div>
                <div class="clear"></div>
            </div>
            
            <h4>OU</h4>
            
            <div class="field">
                <label>Couleur de fond :</label>
                <div class="input">
                    <input type="text" name="backgroundColor" class="text color" value="<?=NE($_POST,'backgroundColor','#ffffff')?>" />
                    <span class="color"></span>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="field comments">
                <label>Boîte de commentaires :</label>
                <div class="input mt10" style="width:200px;">
                    <select name="colorScheme">
                        <option value="light" <?=SEL('light',NEC($_POST,'colorScheme','light'),'string')?>>Pâle</option>
                        <option value="dark" <?=SEL('dark',NEC($_POST,'colorScheme','light'),'string')?>>Foncé</option>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="clear"></div>
    	
        <h4>Aperçu de votre future page</h4>
        
        <div id="preview">
            <iframe src="about:blank" width="100%" height="500" frameborder="0"></iframe>
        </div>
    </div>
        
        <div class="hr"></div>
        
        <h4><a href="#" class="advanced arrow">Options avancées</a></h4>
        
        <div class="advanced" style="display:none;">
        
            <div class="field">
                <label>Titre (balise TITLE) :</label>
                <div class="input">
                    <input type="text" name="titleTag" class="text" />
                    <div class="note">Si vous souhaitez que la balise &lt;title&gt; soit différente du titre/sujet de la page</div>
                </div>
                <div class="clear"></div>
            </div>
        
            <div class="field">
                <label>Description (balise META) :</label>
                <div class="input"><textarea name="description" style="height:50px;"></textarea></div>
                <div class="clear"></div>
            </div>
            
            <div class="field">
                <label>Compte Google Analytics :</label>
                <div class="input">
                    <input type="text" name="analytics" class="text" style="width:200px;" />
                    <span class="note">ex: UA-12345678-1</span>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="field tweet" style="display:none;">
                <label>Hashtag :</label>
                <div class="input"><input type="text" name="hashtag" class="text" /></div>
                <div class="clear"></div>
            </div>
            <div class="field tweet" style="display:none;">
                <label>Via :</label>
                <div class="input">
                    <input type="text" name="via" class="text" /> &nbsp;&nbsp;
                    <span class="note">ajoute «via @...» à la fin du tweet</span>
                </div>
                <div class="clear"></div>
            </div>
            
        </div>
    
    
        
        
    <div class="hr"></div>
    
        
    <h2>3. Propriétaire</h2>
	
    
    <div class="left">
        
        <div class="spacer-small"></div>
        
        <div class="field">
            <label>Envoyez-moi un lien unique<br/><span class="note">Entrez votre adresse courriel ci-dessous pour recevoir un lien unique<br/>vers le panneau d'administration de votre page.</span></label>
            <div class="input mt10">
            	<div>Adresse courriel : <input type="text" name="email" class="text" style="width:300px;" /></div>
            </div>
        </div>
        
        <h4>OU</h4>
        
        <div class="spacer-small"></div>
        
        <div class="field">
            <label>Utilisez un compte externe<br/><span class="note">En liant un de vos comptes externes, vous pourrez l'utiliser<br/>pour vous connecter et modifier votre page.</span></label>
            <div class="input mt10">
                <div class="mt10">
                    <a href="#" class="facebookLogin">&nbsp;</a>
                    <a href="#" class="twitterLogin">&nbsp;</a>
                </div>
            </div>
        </div>
        
        <!--<div class="field">
            <label>Modération de votre page<br/><span class="note">Si vous souhaitez être ajouté comme modérateur de votre page, liez votre compte Facebook</span></label>
            <div class="input">
            </div>
        </div>-->
    </div>
    
    <div class="right"> 
        
        <h3>Modifier votre page</h3>
        <p>Sur zizanie, il n'y a pas de mots de passe. Vous avez toutefois accès à différentes méthodes pour modifier votre page dans le futur.</p>
        <p>Si vous souhaitez pouvoir modifier votre page dans le futur, veuillez fournir votre adresse courriel. Un lien vous sera envoyé et vous pourrez l'utiliser pour accéder au tableau de bord.</p>
        
    </div>
    
    <div class="clear"></div>
    
    <div class="hr"></div>
    
    
    <p align="right"><button type="submit" class="submit">Créer la page »</button></p>
    
    <div class="clear"></div>
    
</form>