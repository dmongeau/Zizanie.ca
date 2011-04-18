<?php

require PATH_ROOT.'/lib/recaptchalib.php';


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
		
		
		require_once PATH_ROOT.'/models/Page.php';
		
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
<div class="left">
    <h1>Créer une page</h1>
    
    <div class="spacer-small"></div>
    
    <?php if(isset($error) && !empty($error)) { ?>
    <div class="error"><?=$error?></div>
    <?php } ?>
    
    <form action="?" method="post">
        
        <div class="field">
            <label>Titre :</label>
            <div class="input"><input type="text" name="title" class="text title" /></div>
        </div>
        
        <div class="field">
            <label>Choisir une adresse :</label>
            <div class="input">http://<input type="text" name="permalink" class="text address" maxlength="30" />&nbsp;&nbsp;.zizanie.ca</div>
        </div>
        
        <div class="field">
            <label>Type de page :</label>
            <div class="input">
            	<label><input type="radio" name="type" value="comments" /> Commentaires</label>
            	<label><input type="radio" name="type" value="tweet" /> Tweet</label>
            	<label><input type="radio" name="type" value="like" /> Like</label>
            </div>
        </div>
        
        <div class="field">
            <label>Description :</label>
            <div class="input"><textarea name="content"></textarea></div>
        </div>
        
        <div class="hr"></div>
        
        <h4><a href="#" class="advanced">Options avancées</a></h4>
        
        <div class="advanced" style="display:none;">
        
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
            
            <div class="field">
                <label>Couleur du texte :</label>
                <div class="input">
                    <input type="text" name="background_color" class="text color" />
                    <span class="color"></span>
                </div>
            	<div class="clear"></div>
            </div>
            
            <div class="hr"></div>
            
            <div class="field">
                <label>Compte Google Analytics :</label>
                <div class="input">
                    <input type="text" name="analytics" class="text" style="width:200px;" />
                    <span class="note">ex: UA-12345678-1</span>
                </div>
            	<div class="clear"></div>
            </div>
        </div>
        
        <div class="hr"></div>
        
        <script type="text/javascript">
		 var RecaptchaOptions = {
			theme : 'clean',
			lang : 'fr'
		 };
		 </script>
        
        <div class="field">
            <label>Êtes-vous un robot ?<br/><span style="font-size:12px;color:#666;font-weight:normal;">Entrez les caractères ci-dessous.</span></label>
            <div class="input">
            <?php
          		echo recaptcha_get_html($this->getConfig('recaptcha.public'));
			?>
            </div>
        </div>
        
        <div class="spacer"></div>
        <p><button type="submit">Créer</button></p>
    
    </form>
</div>