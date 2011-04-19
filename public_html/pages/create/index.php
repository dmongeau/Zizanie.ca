<?php

require PATH_APP.'/lib/recaptchalib.php';


if($_POST) {
	try {
		
		if(!isset($_POST['title']) || empty($_POST['title'])) {
			throw new Exception('Vous devez entrer un titre pour la page');
		}
		
		$privatekey = $this->getConfig('recaptcha.private');
		$resp = recaptcha_check_answer($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$_POST["recaptcha_challenge_field"],
									$_POST["recaptcha_response_field"]);
		
		if(!$resp->is_valid) {
			throw new Exception('Veuillez entrer les bons caractères dans la vérification anti-robot');
		}
		
		require PATH_APP.'/models/Page.php';
		
		$Page = new Page();
		$Page->setData(array(
			'title' => $_POST['title'],
			'published' => 1
		));
		$Page->save();
		$page = $Page->fetch();
		
		
	} catch(Exception $e) {
		$error = $e->getMessage();
	}
}


$this->addStylesheet('/statics/css/colorpicker.css');
$this->addScript('/statics/js/colorpicker.js');
$this->addScript('/statics/js/create.js');


?>

<h1>Créer une page</h1>
  
<div class="spacer-small"></div>
        
<form action="?" method="post">

	<div class="left">
        
        <?php if(isset($error) && !empty($error)) { ?>
        <div class="error"><?=$error?></div>
        <?php } ?>
        
        <h2>1. Création de votre page</h2>
        
        <div class="spacer-small"></div>
        
        <div class="field">
            <label>Titre :</label>
            <div class="input"><input type="text" name="title" class="text title" /></div>
        </div>
        
        <div class="field">
            <label>Choisir une adresse :</label>
            <div class="input">http://<input type="text" name="permalink" class="text address" maxlength="30" />&nbsp;.zizanie.ca</div>
        </div>
        
        <div class="field">
            <label>Type de page :</label>
            <div class="input">
                <label><input type="radio" name="type" value="comments" /> Commentaires</label>
                <label><input type="radio" name="type" value="battle" /> Commentaires (Pour/Contre)</label>
                <label><input type="radio" name="type" value="tweet" /> Bouton Tweet</label>
                <label><input type="radio" name="type" value="like" /> Like</label>
            </div>
        </div>
        
        <div class="hr"></div>
        
        <h2>2. Personnalisation</h2>
        
        <div class="spacer-small"></div>
        
        <h4><a href="#" class="customize arrow">Personnalisez votre page</a></h4>
        
        <div class="customize" style="display:none;">
            
            <div class="field">
                <label>Police :</label>
                <div class="input">
                    <select name="fontFamily">
                        <option value="georgia">Georgia</option>
                        <option value="arial">Arial</option>
                        <option value="verdana">Verdana</option>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="field">
                <label>Couleur du texte :</label>
                <div class="input">
                    <input type="text" name="background_color" class="text color" value="#333333" />
                    <span class="color"></span>
                </div>
                <div class="clear"></div>
            </div>
        
            <div class="field">
                <label>Fond de la page :</label>
                <div class="input">
                    <label class="fleft">Image :</label>
                    <div class="fleft mt10"><input type="file" name="background_image" class="file" /></div>
                    <div class="clear"></div>
                    <h4>OU</h4>
                    <label class="fleft">Couleur :</label>
                    <div class="fleft">
                        <input type="text" name="background_color" class="text color" />
                        <span class="color"></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
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
        
        <div class="spacer"></div> 
        
        <h3>Modifier votre page</h3>
        <p>Si vous souhaitez pouvoir modifier votre page dans le futur, veuillez fournir votre adresse courriel. Un lien vous sera envoyé et vous pourrez l'utiliser pour accéder au tableau de bord.</p>
        
        <div class="spacer"></div> 
        
        <h3>Modération</h3>
        <p>Lorsque vous sélectionnez les types de page «Commentaires» et «Commentaires (Pour/Contre)», vous avez accès une interface de modération. Pour ce faire, vous devez lier votre compte facebook à l'étape 3</p>
        
    </div>
    
    <div class="clear"></div>
        
    <div class="hr"></div>
    
    <h2>3. Aperçu</h2>
    
    <div class="spacer-small"></div>
    
    <div id="preview">
    	<iframe src="about:blank" width="100%" height="300" frameborder="0"></iframe>
    </div>
        
        
    <div class="hr"></div>
	
    
    <div class="left">
    
        
        <h2>4. Propriétaire</h2>
        
        <div class="spacer-small"></div>
        
        <div class="field">
            <label>Modification de votre page<br/><span class="note">Entrez votre adresse courriel ci-dessous pour recevoir un lien vers le panneau d'administration.</span></label>
            <div class="input mt10">
            	Adresse courriel : <input type="text" name="email" class="text" style="width:300px;" />
            </div>
        </div>
        
        <div class="field">
            <label>Modération de votre page<br/><span class="note">Si vous souhaitez être ajouté comme modérateur de votre page, liez votre compte Facebook</span></label>
            <div class="input">
            </div>
        </div>
    </div>
    
    <div class="right">
		<script type="text/javascript">
         var RecaptchaOptions = {
            theme : 'clean',
            lang : 'fr'
         };
         </script>
        
        <div class="field">
            <label>Êtes-vous un robot ?<br/><span class="note">Entrez les caractères ci-dessous.</span></label>
            <div class="input">
            <?php
                echo recaptcha_get_html($this->getConfig('recaptcha.public'));
            ?>
            </div>
        </div>
        
    </div>
    
    <div class="clear"></div>
    
    <div class="hr"></div>
    
    
    <p align="right"><button type="submit" class="submit">Créer la page »</button></p>
    
</form>