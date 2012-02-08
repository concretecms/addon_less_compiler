<?php
class LessCompiler {
	
	function __construct() {
		set_time_limit(3);
	}
	
	public function getFilesArray($dir='./themes') {
		$d = opendir($dir);
		$out = array();
		while($f = readdir($d)) {
			if ($f == '..' || $f == '.')continue;
			if (is_dir($dir."/".$f)) {
				$fs = $this->getFilesArray($dir."/".$f);
				if ($fs) $out[$dir."/".$f] = $this->getFilesArray($dir."/".$f);
			}
			else if (substr($f,-5) == '.less') array_push($out,$dir."/".$f);
		}
		return $out;
	}
	
	public function getFlatFilesArray($dir='./themes',$rem=null) {
		$files = $this->getFilesArray($dir);
		return $this->flatten($files,$dir);
	}
	
	private function flatten(array $arr, $rem=null) {
		$o = array();
		foreach($arr as $a) {
			if (is_array($a)) 
				$o = array_merge($this->flatten($a,$rem),$o);
			else 
				array_push($o,($rem?str_replace($rem,'',$a):$a));
		}
		return $o;
	}
	
	
}