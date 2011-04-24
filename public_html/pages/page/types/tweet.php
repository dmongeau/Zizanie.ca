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



</style>

<div class="opinion" align="center">
    <form action="http://twitter.com/share" method="get" target="_blank">
        <input type="hidden" name="url" value="%{URL}" />
        <input type="hidden" name="text" value="<?=$page['title']?>" />
        <div class="tweet">
            <h1><?=$page['title']?></h1>
            <textarea title="écrivez la suite..."></textarea>
            <input type="image" src="/statics/img/tweet.png" />
        </div>
    
    </form>

</div>
<div class="clear"></div>
<div class="tweets" align="center">
    <script src="http://widgets.twimg.com/j/2/widget.js"></script>
    <script>
        new TWTR.Widget({
          version: 2,
          type: 'search',
          search: '\"<?=$page['title']?>\"',
          interval: 6000,
          title: 'Quelques opinions...',
          subject: '',
          width: 'auto',
          height: 250,
          theme: {
            shell: {
              background: "<?=$Page->background()?>",
              color: "<?=$Page->titleColor()?>"
            },
            tweets: {
              background: '#ffffff',
              color: '#444444',
              links: '#0099FF'
            }
          },
          features: {
            scrollbar: true,
            loop: true,
            live: true,
            hashtags: true,
            timestamp: false,
            avatars: true,
            toptweets: false,
            behavior: 'default'
          }
        }).render().start();
    </script>
</div>