<?php

Kate::setDefaultDatabase(Gregory::get()->db);

class Page extends Kate {
	
	public $source = array(
		'type' => 'db',
		'table' => array(
			'name' => array('p' => 'pages'),
			'primary' => 'pageid',
			'fields' => '*',
			'nowFields' => 'dateadded'
		)
	);
	
	protected function _selectPrimary($select,$primary) {
		
		if(!is_numeric($primary)) {
			$select->where('p.permalink = ?',$primary);	
		} else {
			$select->where('p.pageid = ?',$primary);	
		}
		
		return $select;
			
	}
	
	public function fontFamily() {
		$data = $this->getData();
		
		switch($data['fontFamily']) {
			case 'georgia':
			case 'verdana':
			case 'arial':
				return self::$systemFonts[$data['fontFamily']]['fontFamily'];
			break;
			default:
				if(!$this->isWebFont()) return self::$systemFonts['arial']['fontFamily'];
				else return self::$webFonts[$data['fontFamily']]['fontFamily'];
			break;
		}
	}
	
	public function isWebFont() {
		$data = $this->getData();
		
		if(isset(self::$webFonts[$data['fontFamily']])) return true;
		return false;
	}
	
	public function webFont() {
		$data = $this->getData();
		
		return self::$webFonts[$data['fontFamily']]['name'];
	}
	
	public function getWebFontUrl() {
		$data = $this->getData();
		
		$font = self::$webFonts[$data['fontFamily']];
		
		return 'http://fonts.googleapis.com/css?family='.urlencode(isset($font['url']) ? $font['url']:$font['name']);
	}
	
	public function background() {
		$data = $this->getData();
		return $data['backgroundColor'];
	}
	
	public function borderColor() {
		$data = $this->getData();
		return $data['titleColor'];
	}
	
	public function titleColor() {
		$data = $this->getData();
		return $data['titleColor'];
	}
	
	public static $systemFonts = array(
		'georgia' => array(
			'name' => 'Georgia',
			'fontFamily' => 'Georgia, Times New Roman, serif'
		),
		'verdana' => array(
			'name' => 'Verdana',
			'fontFamily' => 'Verdana, Geneva, Sans-serif'
		),
		'arial' => array(
			'name' => 'Arial',
			'fontFamily' => 'Arial, Helvetica, Sans-serif'
		)
	);
	
	public static $webFonts = array(
		'cherry' => array(
			'name' => 'Cherry Cream Soda',
			'fontFamily' => '\'Cherry Cream Soda\', serif'
		),
		
		'specialelite' => array(
			'name' => 'Special Elite',
			'fontFamily' => '\'Special Elite\', serif'
		),
		'quattrocento' => array(
			'name' => 'Quattrocento Sans',
			'fontFamily' => '\'Quattrocento Sans\', sans-serif',
		),
		'thegirlnextdoor' => array(
			'name' => 'The Girl Next Door',
			'fontFamily' => '\'The Girl Next Door\', sans-serif',
		),
		'smythe' => array(
			'name' => 'Smythe',
			'fontFamily' => '\'Smythe\', serif',
		),
		'corben' => array(
			'name' => 'Corben',
			'url' => 'Corben:bold',
			'fontFamily' => '\'Corben\', serif',
		),
		'kreon' => array(
			'name' => 'Kreon',
			'fontFamily' => '\'Kreon\', serif',
		),
		'annieuse' => array(
			'name' => 'Annie Use Your Telescope',
			'fontFamily' => '\'Annie Use Your Telescope\', serif',
		),
		'bangers' => array(
			'name' => 'Bangers',
			'fontFamily' => '\'Bangers\', serif',
		),
		'vt323' => array(
			'name' => 'VT323',
			'fontFamily' => '\'VT323\', serif',
		),
		'sixcaps' => array(
			'name' => 'Six Caps',
			'fontFamily' => '\'Six Caps\', serif',
		),
		'anonymouspro' => array(
			'name' => 'Anonymous Pro',
			'fontFamily' => '\'Anonymous Pro\', serif',
		),
		'terminaldosis' => array(
			'name' => 'Terminal Dosis Light',
			'fontFamily' => '\'Terminal Dosis Light\', serif',
		),
		'indieflower' => array(
			'name' => 'Indie Flower',
			'fontFamily' => '\'Indie Flower\', serif',
		),
		'sunshiney' => array(
			'name' => 'Sunshiney',
			'fontFamily' => '\'Sunshiney\', serif',
		),
		'ebgaramond' => array(
			'name' => 'EB Garamond',
			'fontFamily' => '\'EB Garamond\', serif',
		),
		'lekton' => array(
			'name' => 'Lekton',
			'fontFamily' => '\'Lekton\', serif',
		),
		'novaround' => array(
			'name' => 'Nova Round',
			'fontFamily' => '\'Nova Round\', serif',
		),
		'cabinsketch' => array(
			'name' => 'Cabin Sketch',
			'fontFamily' => '\'Cabin Sketch\', serif',
			'url' => 'Cabin Sketch:bold',
		),
		/*'quattrocento' => array(
			'name' => '',
			'fontFamily' => '\'\', serif',
		),*/
	);
	
}