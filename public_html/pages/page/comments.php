<style type="text/css">

	body {
		<?=$Page->fontFamily()?>
		<?=$Page->background()?>
	}
	
	#content h1 {
		font-size:<?=$page['titleSize']?>px !important;
		<?=$Page->titleColor()?>
		margin:50px 0;	
	}
	
	#comments {
		background:#fff;
	}	
	#loading {
		line-height:1.5em;
	}


</style>


<script type="text/javascript">
	$(function() {
		$(window).load(function() {
			$('#loading').hide();
			$('#comments').fadeIn('fast');
		});
	});
</script>


<h1 align="center"><?=$page['title']?></h1>

<div id="loading" align="center">Chargement des commentaires...<br/><img src="/statics/img/loading.gif" /></div>

<div id="comments" style="display:none;">
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/fr_CA/all.js"></script>
	<fb:comments href="http://<?=$_SERVER['HTTP_HOST']?>" num_posts="50" width="720" showform="true" canpost="true" publish_feed="true"></fb:comments>
</div>