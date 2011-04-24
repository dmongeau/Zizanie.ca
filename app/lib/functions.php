<?php


function EX($return){
	
	if(is_string($return)){
		header('Content-type: text/plain; charset="utf-8"');
		echo $return;
	} else {
		header('Content-type: text/html; charset="utf-8"');
		var_dump($return);
	}
	
	exit();
	
}

function DEBUG($var) {
	var_dump($var);
	exit();
}

function QUO($str,$encoding = "utf-8") {
	return htmlspecialchars($str,ENT_QUOTES,$encoding);
}

function UNQUO($str) {
	return htmlspecialchars_decode($str);
}

function NE($array,$key,$empty = "") {
	if(isset($array[$key]) && $array[$key] != '') return (!is_array($array[$key])) ? QUO(stripslashes($array[$key])):QUO($array[$key]);
	else return $empty;
}

function NEC($array,$key,$empty = "") {
	if(isset($array[$key])) return (!is_array($array[$key])) ? (stripslashes($array[$key])):($array[$key]);
	else return $empty;
}

function SEL($input,$value,$type = "integer") {
	if($type == "integer") return ((int)$input == (int)$value) ? " selected='selected'":"";
	elseif($type == "string") return ((string)$input == (string)$value) ? " selected='selected'":"";
	else return ($input == $value) ? " selected='selected'":"";
}

function CLA($input,$value,$class = "selected",$type = "string") {
	if($type == "integer") return ((int)$input == (int)$value) ? " ".$class:"";
	elseif($type == "string") return ((string)$input == (string)$value) ? " ".$class:"";
	else return ($input == $value) ? " ".$class:"";
}



function getdomain($url)
{
	$url = str_replace("http://","",$url);
	$explode = explode(".", $url);
	$tld = (isset($explode[2])) ? $explode[2]:$explode[1];
	$tld = explode("/", $tld);
	$name = (isset($explode[2])) ? $explode[1]:$explode[0];
	return $name.".".$tld[0];
}

function getUrlParam($url,$name) {
	$query = substr($url,strpos($url,"?")+1);
	$params = explode("&",$query);
	
	foreach($params as $param) {
		$p = explode("=",$param);
		if(strtolower($p[0]) == $name) {
			return $p[1];
			 
		}
	}
	
	return "";
}

function ucname($string) {
    $string = mb_convert_case(mb_convert_case($string,MB_CASE_LOWER,'utf-8'),MB_CASE_TITLE,'utf-8');

    foreach (array('-', '\'') as $delimiter) {
      if (strpos($string, $delimiter)!==false) {
		$parts = explode($delimiter, $string);
		$strParts = array();
		foreach($parts as $part) {
			$strParts[]  = mb_convert_case($part,MB_CASE_TITLE,'utf-8');
		}
        $string=implode($delimiter, $strParts);
      }
    }
    return $string;
}
