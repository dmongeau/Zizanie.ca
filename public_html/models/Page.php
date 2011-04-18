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
	
}