<?php

?>
<div class="left">
    <h1>Créer un site</h1>
    
    <div class="spacer-small"></div>
    
    <form action="?" method="post">
        
        <div class="field">
            <label>Choisissez une adresse :</label>
            <div class="input">http://<input type="text" name="title" class="text address" maxlength="20" />.zizanie.ca</div>
        </div>
        
        <div class="hr"></div>
        
        <div class="field">
            <label>Titre :</label>
            <div class="input"><input type="text" name="title" class="text title" /></div>
        </div>
        
        <div class="field">
            <label>Description :</label>
            <div class="input"><textarea name="content"></textarea></div>
        </div>
        
        <div class="hr"></div>
        
        <h4><a href="#" class="advanced">Options avancées</a></h4>
        
        <div class="advanced" style="display:none;">
            <div class="field">
                <label>Compte Google Analytics :</label>
                <div class="input">
                    <input type="text" name="analytics" class="text" style="width:200px;" />
                    <span class="note">ex: UA-12345678-1</span>
                </div>
            </div>
        </div>
        
        <div class="hr"></div>
        
        <div class="field">
            <label>Vérification anti-robot :</label>
            <div class="input"><input type="text" name="title" class="text title" /></div>
        </div>
        
        <div class="spacer"></div>
        <p><button type="submit">Créer</button></p>
    
    </form>
</div>