<style type="text/css">

	body {
		font-family:Arial, Helvetica, sans-serif;
		background:#fff;
		font-family: <?=$Page->fontFamily()?>;
		background: <?=$Page->background()?>;
	}
	
	#content h1 {
		font-family: <?=$Page->fontFamily()?>;
		text-align: <?=$page['titleAlign']?>;
		font-size:<?=$page['titleSize']?>px;
		color: <?=$Page->titleColor()?>	;
	}
	
	#content h2 {
		font-family: <?=$Page->fontFamily()?>;
		color:<?=$Page->titleColor()?>;
	}


</style>


<h1 align="center"><?=$page['title']?></h1>

<div>
    <div class="col mr10" style="background:transparent;">
        <h2 align="center">Pour</h2>
    </div>
    <div class="col" style="background:transparent;">
        <h2 align="center">Contre</h2>
    </div>
    <div class="clear"></div>
</div>

<div id="loading" align="center">Chargement des commentaires...<br/><img src="/statics/img/loading.gif" /></div>

<div id="comments" class="<?=NE($page,'colorScheme','light')?>" style="display:none; background:transparent; padding:0px;">
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/fr_CA/all.js"></script>
    <div class="col mr10">
		<fb:comments href="%{URL}/pour" num_posts="50" width="345" showform="true" canpost="true" publish_feed="true" colorscheme="<?=NE($page,'colorScheme','light')?>"></fb:comments>
    </div>
    <div class="col">
    	<fb:comments href="%{URL}/contre" num_posts="50" width="345" showform="true" canpost="true" publish_feed="true" colorscheme="<?=NE($page,'colorScheme','light')?>"></fb:comments>
    </div>
    <div class="clear"></div>
</div>