<style type="text/css">

	body {
		background: #fff;
		font-family: <?=$Page->fontFamily()?>;
		background: <?=$Page->background()?>;
	}
	
	#content h1 {
		font-family: <?=$Page->fontFamily()?>;
		text-align: <?=$page['titleAlign']?>;
		font-size: <?=$page['titleSize']?>px;
		color: <?=$Page->titleColor()?>;
	}


</style>

<h1 align="center"><?=$page['title']?></h1>

<div id="loading" align="center">Chargement des commentaires...<br/><img src="/statics/img/loading.gif" /></div>

<div id="comments" style="display:none;">
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/fr_CA/all.js"></script>
	<fb:comments href="%{URL}" num_posts="50" width="710" showform="true" canpost="true" publish_feed="true" colorscheme="<?=NE($page,'colorScheme','light')?>"></fb:comments>
</div>