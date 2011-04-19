<?php

//Kate::setDefaultDatabase(Gregory::get()->db);

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
				return 'font-family: Georgia, Times New Roman, Sans-serif !important; ';
			break;
			case 'verdana':
				return 'font-family: Verdana, Geneva, Sans-serif !important; ';
			break;
			default:
				return 'font-family: Arial, Helvetica, Sans-serif !important; ';
			break;
		}
	}
	
	public function background() {
		$data = $this->getData();
		return 'background-color:'.$data['backgroundColor'].' !important; ';
	}
	
	public function borderColor() {
		$data = $this->getData();
		return 'border-color:'.$data['titleColor'].' !important; ';
	}
	
	public function titleColor() {
		$data = $this->getData();
		return 'color:'.$data['titleColor'].' !important; ';
	}
	
}